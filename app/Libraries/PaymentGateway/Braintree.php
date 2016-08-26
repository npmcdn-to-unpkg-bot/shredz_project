<?php

namespace App\Libraries\PaymentGateway;

use Braintree\Configuration;
use Braintree\Transaction;
use Braintree\ClientToken;
use Braintree\PaymentMethod;
use Braintree\CustomerSearch;
use Braintree\Customer as Braintree_Customer;

class Braintree extends BaseGateway implements GatewayInterface
{
    protected $verifyCardOnMethodCreate = true;
    protected $failOnDuplicatePaymentMethod = true;
	protected $configuration;
    protected $paymentProfileKeys = [
        'cardholderName' => 'address_name',
        'expirationMonth' => 'expiration_month',
        'expirationYear' => 'expiration_year',
        'last4' => 'last_four',
        'cardType' => 'type',
        'expirationDate' => 'expiration_date',
        'token' => 'billing_reference',
        'customerId' => 'customer_id',
        'streetAddress' => 'address_street',
        'locality' => 'address_city',
        'region' => 'address_state',
        'postalCode' => 'address_zip',
        'countryCodeAlpha2' => 'address_country_code',
        'countryName' => 'address_country_name',
        'maskedNumber' => 'cc_masked_number'
    ];

	 /**
     * Create a new instance of Braintree
     */
    public function __construct($name = null)
    {
    	parent::__construct($name);
        return $this->setConfiguration($name ?: 'default');
    }

	/**
     * Configure Braintree
     * @param  array    $options
     */
    public function configure(array $config)
    {

        try {
            Configuration::environment($config['environment']);
            Configuration::merchantId($config['merchantId']);
            Configuration::publicKey($config['publicKey']);
            Configuration::privateKey($config['privateKey']);
        } catch (Exception $e) {
            throw new Exception('Braintree configuration is invalid.');
        }
    }

    /**
     * @param $name
     * @return static
     */
    public function setConfiguration($name = 'default')
    {
        $this->configuration = 'braintree.' . $name;
        $this->configure($this->config() ?: []);
        $this->gatewayName = 'Braintree';
        $this->paymentGateway = $this;
        return $this->paymentGateway;
    }

    /**
     * Retrieve a customer from Braintree
     * @param int $id
     * @return array $customer
     */
    public function getCustomer($id)
    {
        $customer = [];
        try {
            $collection = Braintree_Customer::search([
                CustomerSearch::id()->is($id)
            ]);
        } catch (Braintree\Exception\NotFound $e) {
            $this->response = false;
            $this->failMsg = $e->getMessage();
            return $customer;
        }
        $this->response = true;
        foreach ($collection as $returnedCustomer) {
            $customer['id'] = $returnedCustomer->id;
            $customer['first_name'] = $returnedCustomer->firstName;
            $customer['last_name'] = $returnedCustomer->lastName;
            $customer['contact_phone'] = $returnedCustomer->phone;
            $customer['contact_email'] = $returnedCustomer->email;
            $customer['phone'] = $returnedCustomer->phone;
        }
        if(!count($customer)){
            $this->response = false;
            $this->failMsg = 'The customer you are looking for does not exist. Please contact Support.';
            return $customer;
        }
        $customer = $this->customerFields($customer);
        return $customer;
    }

    /**
     * Store a new customer in Braintree
     * @param array $data
     * @return int id || null
     */
    public function createCustomer($data)
    {
        try {
            $result = Braintree_Customer::create($data);
        } catch (Exception $e) {
            $this->response = false;
            $this->failMsg = $e->getMessage();
            return null;
        }
        $this->response = true;
        return $result->customer->id;
    }

    /**
     * Create a new payment method in braintrree for a given customer
     * @param array $data
     * @return array $paymentMethod
     */
    public function addPaymentMethod($data)
    {
        $paymentMethod = [];
        $data['options'] = ['verifyCard' => $this->verifyCardOnMethodCreate ];
        $data['options'] = ['failOnDuplicatePaymentMethod' => $this->failOnDuplicatePaymentMethod];
        $data['options'] = ['makeDefault' => $data['primary']];
        unset($data['primary']);
        try {
            $response = PaymentMethod::create($data);
            // dd($response);
        } catch (Exception $e) {
            $this->response = false;
            //$this->failMsg = $e->getMessage();
            $this->failMsg = 'This Payment method could not get stored. Try again later or contact support.';
            return $paymentMethod;
        }
        if($response->success){
            $btPaymentMethod = $response->paymentMethod;
            $paymentArr = explode(', ', $btPaymentMethod->__toString());
            $transPaymentArr = [];
            foreach ($paymentArr as $value) {
                $length = strlen($value);
                $equalIndex = stripos($value, '=');
                $transPaymentArr[substr($value, 0, $equalIndex)] = substr($value, $equalIndex + 1, $length);
            }
            $paymentMethod = [];
            foreach ($transPaymentArr as $key => $value) {
                if(array_key_exists($key, $this->paymentProfileKeys)){
                    $paymentMethod[$this->paymentProfileKeys[$key]] = $value;
                }
            }
            $this->response = true;
            $paymentMethod = $this->paymentProfileFields($paymentMethod);
            return $paymentMethod;
        }else{
            foreach ($response->errors->deepAll() as $message) {
                $this->failMsg = $message->message;
                break;
            }
            $this->response = false;
            return $paymentMethod;
        }
        $this->response = false;
        $this->failMsg = 'This payment method could not get stored. Please try again later or contact support.';
        return $paymentMethod;
    }

    /**
     * Get a payment method from Braintree
     * @param string $billing_reference
     * @return bool
     */
    public function updatePaymentMethod($billing_reference, array $data)
    {
        $options = $data['options'];
        unset($data['options']);
        try {
            $response = PaymentMethod::update($billing_reference, [
                'billingAddress' => $data,
                'options' => $options
            ]);
        } catch (Exception $e) {
            $this->response = false;
            //$this->failMsg = $e->getMessage();
            $this->failMsg = 'This Payment method could not get updated. Try again later or contact support.';
            return false;
        }
        if($response->success == true){
            $this->response = true;
            return true;
        }else{
            foreach ($response->errors->deepAll() as $error) {
                $this->failMsg = $error->message;
                break;
            }
            $this->response = false;
            return false;
        }
        $this->response = false;
        $this->failMsg = 'This Payment method could not get updated. Try again later or contact support.';
        return false;
    }

    public function deletePaymentMethod($token){
        try {
            $result = Braintree_PaymentMethod::delete($token);
        } catch (Exception $e) {
            $this->response = false;
            $this->failMsg = $e->getMessage();
            //$this->failMsg = 'This Payment method could not get deleted. Please try again later.';
            return false;
        }
        if($result->success){
            $this->response = true;
            return true;
        }else{
            foreach ($result->errors->deepAll() as $error) {
                $this->failMsg = $error->message;
                break;
            }
            $this->response = false;
            return false;
        }
    }

    /**
     * @return Braintre/Configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }


    public function config($path = null, $default = null)
    {
        $path = $this->configuration . (empty($path) ? '' : '.' . $path);
        return config($path, $default);
    }

    public function getClientToken()
    {
        return ClientToken::generate();
    }

    public function makePayment($billingReference, $amount, $externalId)
    {
        try{
            $result = Braintree_PaymentMethodNonce::create($billingReference);
            $paymentMethodNonce = $result->paymentMethodNonce;
            $nonce = $paymentMethodNonce->nonce;
            $threeDSecure = !is_null(@$paymentMethodNonce->threeDSecureInfo);
            $result = $this->makePaymentFromNonce($externalId, (double) $amount, $nonce, ['three_d_secure' => ['required' => $threeDSecure]]);
            if($result->success){
                return new RemoteResponse(true,
                    [
                        'transaction_id' => $result->transaction->id,
                        'currency_code'  => $result->transaction->currencyIsoCode
                    ]
                );
            }else{
                return $this->parseErrorResponse($result);
            }
        }catch(Braintree\Exception\NotFound $e){
            return new RemoteResponse(false, 'Payment method not found.');
        }catch(Exception $e){
            return new RemoteResponse(false, $e->getMessage() . "/n" . $e->getTraceAsString());
        }
    }

    protected function parseErrorResponse($result){
        $messages = [];
        if(count($result->errors->deepAll())){
            foreach($result->errors->deepAll() as $error){
                $messages[] = $error->code . ": " . $error->message;
            }
        }else{
            $messages[] = $result->message;
        }
        return new RemoteResponse(false, implode('; ', $messages));
    }

    public function makePaymentFromNonce($orderId, $amount, $nonce, array $options = [], array $payload = [])
    {
        $options = array_merge(
            $this->config('options.sale', []),
            $options
        );
        $payload = array_merge(
            $payload,
            [
                'amount' => number_format($amount, 2, '.', ''),
                'orderId' => $orderId,
                'paymentMethodNonce' => $nonce,
                'merchantAccountId' => $this->config('merchantAccountId', null),
                'options' => $options,
            ] );
        return Transaction::sale(array_filter($payload));
    }

    /**
     * @return static
     */
    // public function makePaymentFromCustomer($orderId, $amount, array $options = [], array $payload = [])
    // {
    //     if (!$this->customer) {
    //         throw new Exception('The method `makePaymentFromCustomer` requires a customer to update. Use `withStoreCustomer($email)` first to set a customer.');
    //     }
    //     $options = array_merge(
    //         $this->config('options.sale', []),
    //         $options
    //     );
    //     $payload = array_merge(
    //         $payload,
    //         [
    //             'amount' => number_format($amount, 2, '.', ''),
    //             'orderId' => $orderId,
    //             'customerId' => $this->customer->id,
    //             'merchantAccountId' => $this->config('merchantAccountId', null),
    //             'options' => $options,
    //         ] );
    //     Log::info('Payment Payload: ' . PHP_EOL . json_encode($payload, JSON_PRETTY_PRINT));
    //     $this->lastResponse = Transaction::sale(array_filter($payload));
    //     return $this;
    // }

    /**
     * @return static
     */
    //  public function makePaymentFromVault($orderId, $token, $amount, array $options = [], array $payload = [])
    // {
    //     $options = array_merge(
    //         $this->config('options.sale', []),
    //         $options
    //     );
    //     $payload = array_merge(
    //         $payload,
    //         [
    //             'amount' => number_format($amount, 2, '.', ''),
    //             'orderId' => $orderId,
    //             'paymentMenthodToken' => $token,
    //             'merchantAccountId' => $this->config('merchantAccountId', null),
    //             'options' => $options,
    //         ] );
    //     $this->lastResponse = Transaction::sale(array_filter($payload));
    //     return $this;
    // }

    /**
     * @param $transactionId
     * @param $amount
     * @return static
     */
    // public function settleTransaction($transactionId, $amount = null)
    // {
    //     $this->lastResponse = Transaction::submitForSettlement($transactionId, $amount);
    //     return $this;
    // }

    /**
     * @param $transactionId
     * @return static
     */
    // public function voidPayment($transactionId)
    // {
    //     $this->lastResponse = Transaction::void($transactionId);
    //     return $this;
    // }

    /**
     * @param $transactionId
     * @return static
     */
    // public function refundPayment($transactionId)
    // {
    //     $this->lastResponse = Transaction::refund($transactionId);
    //     return $this;
    // }
    /**
     * @param $transactionId
     * @return static
     */
    // public function findTransaction($transactionId)
    // {
    //     $this->lastResponse = Transaction::find($transactionId);
    //     return $this;
    // }


    /**
     * @return static
     */
    // public function deleteCustomer()
    // {
    //     $this->lastResponse = Braintree_Customer::delete($this->customer->id);
    //     return $this;
    // }

    /**
     * @return static
     */
    // public function findCustomer()
    // {
    //     if (!$this->customer) {
    //         throw new Exception('The method `findCustomer` requires a customer to find. Use `withStoreCustomer($email)` first to set a customer.');
    //     }
    //     $this->btCustomer
    //     = $this->lastResponse
    //     = Braintree_Customer::find($this->customer->id);
    //     return $this;
    // }

    /**
     * Find the customer from Braintree and create  new one if its not there
     */
    // public function findOrCreateCustomer(array $paymentInfo = [])
    // {
    //     try {
    //         return $this->findCustomer();
    //     } catch (NotFound $e) {
    //         return $this->createCustomer($paymentInfo);
    //     }
    // }

    /**
     * Search for a customer in Braintree by given customer fields
     * @return static
     */
    // public function searchCustomer(array $query = [])
    // {
    //     $this->lastResponse = Braintree_Customer::search($query);
    //     return $this;
    // }

    /**
     * @return static
     */
    // public function updateCustomerInfo()
    // {
    //     if (!$this->customer) {
    //         throw new Exception('The method `updateCustomer` requires a customer to update. Use `withStoreCustomer($email)` first to set a customer.');
    //     }
    //     $this->lastResponse = Braintree_Customer::update(
    //         $customer->id, [
    //             'firstName' => $this->customer->first_name,
    //             'lastName' => $this->customer->last_name,
    //             'email' => $this->customer->payer_email,
    //             'phone' => $this->customer->contact_phone,
    //         ] );
    //     return $this;
    // }

    /**
     * @param string $token
     * @return static
     */
    // public function findPaymentMethod($token)
    // {
    //     $this->lastResponse = PaymentMethod::find($token);
    //     return $this;
    // }

    /**
     * @param array $billing
     * @param array $options
     * @param array $payload
     *
     * @return static
     */
    // public function createPaymentMethod(array $billing = [], array $options = [], array $payload = [])
    // {
    //     if (!$this->customer) {
    //         throw new Exception('The method `findCustomer` requires a customer to find. Use `withStoreCustomer($email)` first to set a customer.');
    //     }
    //     $options = array_merge($this->config('options.payment', []), $options);
    //     $payload = array_merge(
    //         $payload, [
    //             'customerId' => $this->customer->id,
    //             'paymentMethodNonce' => $this->nonce,
    //             'billingAddress' => $billing,
    //             'options' => $options,
    //         ] );
    //     $this->lastResponse = PaymentMethod::create(array_filter($payload));
    //     return $this;
    // }

    /**
     * @param string $token
     * @param array $billing
     * @param array $options
     */
    // public function updatePaymentMethod($token, array $billing = [], array $options = [])
    // {
    //     $options = array_merge(
    //         $this->config('options.billing', []),
    //         $options
    //     );
    //     if (!empty($billing)) {
    //         $billing['options']
    //         = !empty($billing['options'])
    //         ? array_merge($options, $billing['options'])
    //         : $options;
    //     }
    //     $this->lastResponse = PaymentMethod::update($token, [
    //         'billingAddress' => $billing
    //     ]);
    //     return $this;
    // }

    /**
     * @param string $token
     * @param static
     */
    // public function setDefaultPaymentMethod($token)
    // {
    //     $this->lastResponse = PaymentMethod::update($token, [
    //         'options' => [ 'makeDefault' => true ]
    //     ]);
    //     return $this;
    // }

    /**
     * @param string $token
     * @return static
     */
    // public function deletePaymentMethod($token)
    // {
    //     $this->lastResponse = PaymentMethod::delete($token);
    //     return $this;
    // }

    // public function response()
    // {
    //     return $this->lastResponse;
    // }

    // public function succeeds()
    // {
    //     return $this->lastResponse && isset($this->lastResponse->success) ? $this->lastResponse->success : false;
    // }

    //  public function fails()
    // {
    //     return $this->lastResponse && isset($this->lastResponse->success) ? !$this->lastResponse->success : false;
    // }

    /**
     * return the customer from braintree
     */
    // public function customer()
    // {
    //     return $this->btCustomer;
    // }

    /**
     * Determine whether or not the has been found on braintree
     * @return bool
     */
    // public function customerFound($insist = false)
    // {
    //     $found = isset($this->btCustomer);
    //     if ($insist && !$found) {
    //         throw new Exception('Braintree customer not found.');
    //     }
    //     return $found;
    // }


}
