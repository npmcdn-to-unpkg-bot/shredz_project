<?php

use Braintree\Configuration;
use Braintree\Transaction;
use Braintree\ClientToken;
use Braintree\PaymentMethod;
use Braintree\CustomerSearch;
use Braintree\Customer as Braintree_Customer;

class WeHandlePay extends BaseGateway
{

	 /**
     * Create a new instance of Braintree
     */
    public function __construct($name = null)
    {
    	parent::__construct($name);
    }

    public function makePayment($billingReference, $amount, $externalId)
    {
        try{
            $weHandlePay = new WeHandlePayAPI();
            $result = $weHandlePay->makePayment($payload);
            if($result['status'] == 201 &&
                    isset($result['content']) &&
                    isset($result['content']['data']) &&
                    $result['content']['data']['is_successful'] &&
                    $result['content']['data']['status'] == 'completed'){
                return new RemoteResponse(true,
                    [
                        'transaction_id'    => $result['content']['data']['transaction_ref'],
                        'currecy_code'      => $weHandlePay->getDefaultCurrencyCode()
                    ]
                );
            }else{
                return $this->parseErrorResponse($result);
            }
        }catch(Exception $e){
            return new RemoteResponse(false, $e->getMessage() . "/n" . $e->getTraceAsString());
        }
    }

    protected function parseErrorResponse($result){
        $errorMessages = [];
        if(isset($result['content']['error'])){
            foreach($result['content']['error'] as $errors){
                $errorMessages[] = implode(' ', $errors);
            }
        }else{
            $errorMessages[] = 'WeHandlePay returned an error status' . $result['status'];
        }
        return new RemoteResponse(false, implode(', ', $errorMessages));
    }

    public function getCustomer($id){

    }
    public function addPaymentMethod($data){

    }
    public function createCustomer($data){

    }
}
