<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\DataController;
use App\Libraries\PaymentGateway\Braintree;
use App\Libraries\PaymentGateway\PaymentGateway;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use FitlifeGroup\Models\Eloquent\Customer;
use FitlifeGroup\Models\Eloquent\PaymentProfile;

class PaymentProfileController extends DataController
{

    protected $paymentGateway;

    /**
     * Construct the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        // parent::__construct();
        // $this->beforeFilter('customer_service'); // Customer service can access.
        $this->paymentGateway = new PaymentGateway();
    }

    /**
     * Store a new credit card and add or create a new address and attach to customer
     * @param int $id Customer id
     * 
     */
    public function store($id)
    {    
        $validator = $this->validator(Input::all());
        if($validator->fails()){
            return Response::json(['errors' => $validator->errors()], 422);
        }
        $gatewayName = $this->paymentGateway->getName();
        $customer = Customer::with('addresses', 'paymentProfiles')->findOrFail($id);
        //verify that the customer exists before adding payment method
        $gatewayCustomer = $this->paymentGateway->getCustomer($id);
        if(!$this->paymentGateway->getResponse()){
            //create the customer if the customer does not exists in gateway
            $btCustomerdata = [
                'id' => $customer->id,
                'firstName' => $customer->first_name,
                'lastName' => $customer->last_name,
                'company' => $customer->payer_business_name,
                'email' => $customer->payer_email,
                'phone' => $customer->contact_phone
            ];
            $gatewayCustomerId = $this->paymentGateway->createCustomer($btCustomerdata);
            if(!$this->paymentGateway->getResponse()){
                return Response::json(['errors' => ['customer' => [$this->paymentGateway->getMessage()]]], 422); 
            }
            $gatewayCustomer = $this->paymentGateway->getCustomer($gatewayCustomerId);
        }
        if($gatewayCustomer['id'] == $customer->id){//continue only if we have the same customer on both sides
            if(Input::get('primary') == 'true'){
              $primaryValue = true;
            }else if(Input::get('primary') == 'false'){
              $primaryValue = false;
            }
            $paymentMethodData = [
                'customerId' => $customer->id,
                'paymentMethodNonce' => Input::get('nonce_token'),
                'billingAddress' => ['postalCode' => Input::get('postal_code')],
                'primary' => $primaryValue
            ];
            $paymentMethod = $this->paymentGateway->addPaymentMethod($paymentMethodData);
            // print_r($paymentMethod);
            // die();
            if(!$this->paymentGateway->getResponse()){
                return Response::json(['errors' => ['customer' => [$this->paymentGateway->getMessage()]]], 422); 
            }
            $data = [
                'success' => 'Payment method added.',
                'last_four' => $paymentMethod['last_four'],
                'billing_reference' => $paymentMethod['billing_reference'],
                'type' => PaymentProfile::TYPE_CREDIT_CARD,
                'creditcard_type' => strtolower($paymentMethod['type']),
                'billing_zip' => $paymentMethod['address_zip'],
                'expiration_date' => $paymentMethod['expiration_year'].'-'.$paymentMethod['expiration_month'].'-'.cal_days_in_month(CAL_GREGORIAN, $paymentMethod['expiration_month'], $paymentMethod['expiration_year']),
                // 'customer_id' => $paymentMethod['customer_id'],
                'primary' => Input::get('primary'),
                'gateway' => $gatewayName
              ];
              // $this->createPaymentProfile($customer, $data, Input::get('primary'));
              return Response::json($data, 200);                       
        }//end same ids        
    }

    /**
     * Update a payment profile's billing address
     */
    public function update($id)
    {
      $validator = $this->validator(Input::all());
        if($validator->fails()){
            return Response::json(['errors' => $validator->errors()], 422);
        } 
      $data = [
        'postalCode' => Input::get('postal_code'),
        'options' => [
          'updateExisting' => true
        ]
      ];
      $customer = Customer::with('addresses', 'paymentProfiles')->findOrFail($id);
        //Update payment profiles set all to non-primary if primary true
       if(Input::get('primary') == 'true'){
         foreach ($customer->paymentProfiles as $profile) {
              $profile->primary = NULL;
              $profile->save();
          }
      }
      $payment = PaymentProfile::with('billingAddress')->findOrFail(Input::get('payment_id'));
      if(Input::get('primary') == 'true'){
        $payment->primary = 1;
        $primaryValue = true;
      }else if(Input::get('primary') == 'false'){
        $payment->primary = NULL;
        $primaryValue = false;
      }
      $options = ['makeDefault' => $primaryValue];
      $data['options'] = $options; 
      $updatedInGateway = $this->paymentGateway->updatePaymentMethod($payment->billing_reference, $data);
      if(!$this->paymentGateway->getResponse()){
         return Response::json(['errors' => ['customer' => [$this->paymentGateway->getMessage()]]], 422); 
      }
      $payment->billing_zip = Input::get('postal_code');
      $payment->save();  
      return Response::json(['success' => 'Payment method updated.'], 200);
    }

    /**
     * Remove a payment profile from the gateway and db
     * @param int $id
     * @return bool
     */
    public function delete()
    {
      $profile = PaymentProfile::find(Input::get('profile_id'));
      if($profile->primary == 1){
        return Response::json(['error' => 'The primary payment method cannot be removed'], 200);
      }
      if($this->paymentGateway->deletePaymentMethod($profile->billing_reference)){
        $profile->delete();
        return Response::json(['success' => 'Payment method deleted.'], 200);
      }
      return Response::json(['error' => 'Something went wrong. Please contact support.'], 200);
    }

    /**
     * Create a payment profile locally
     * @param Customer $customer
     * @param array $data
     * @param Address $address
     * @return bool
     */
    private function createPaymentProfile(Customer $customer, $data, $primary)
    {
        if($customer->paymentProfiles->count()){
            if($primary == 'true'){
              $customer->paymentProfiles->each(function($p){
                $p->primary = 0;
                $p->save();
              });
              $data['primary'] = 1;
              $profile = PaymentProfile::create($data);
            }else if($primary == 'false'){
              $data['primary'] = 0;
              $profile = PaymentProfile::create($data);
            }
        }else{
          $profile = PaymentProfile::create($data);
          $profile->primary = 1;
        }
          $customer->paymentProfiles()->save($profile);
          return true;
    }

    /**
     * Return a validator instance when adding a new cc with no creditcard
     * @param array $param
     * @return Validator
     */
    public function validator($data)
    {
        return Validator::make($data, [
            'nonce_token' => 'required',
            'postal_code' => 'required'
        ]);
    }
}