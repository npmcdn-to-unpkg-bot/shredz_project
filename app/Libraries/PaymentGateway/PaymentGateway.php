<?php

namespace App\Libraries\PaymentGateway;

use Braintree\Configuration;
// use App\Libraries\PaymentGateway\Braintree;

class PaymentGateway implements GatewayInterface{

	//Payment gateway consts matches class name
	const GATEWAY_BRAINTREE 	= 'Braintree';
	const GATEWAY_WE_HANDLE_PAY = 'WeHandlePay';
	// const GATEWAY_PAYPAL 		= 'Paypal';

	/**
	 * The current payment gateway object
	 */
	protected $gateway;
	
	/**
	 * The name of the Gateway
	 */
	protected $name;

	public function __construct($gateway = null)
	{
		// die($gateway);
		$gateway = $gateway ? $gateway : self::GATEWAY_BRAINTREE;
		if(Configuration::environment() == 'testing'){
			$mockedGateway = 'Mocked' . $gateway;
			$this->gateway = new $mockedGateway(); 
		}else{
			if($gateway == self::GATEWAY_BRAINTREE) $this->gateway = new Braintree(); 
			else $this->gateway = new WeHandlePay(); 
		}
		$this->name = $gateway;
	}

	public function getCustomer($id){
		return $this->gateway->getCustomer($id);
	}

	public function createCustomer($data)
	{
		return $this->gateway->createCustomer($data);
	}

	public function addPaymentMethod($data)
	{
		return $this->gateway->addPaymentMethod($data);
	}

	public function updatePaymentMethod($billing_reference, array $data)
	{
		return $this->gateway->updatePaymentMethod($billing_reference, $data);
	}

	public function deletePaymentMethod($token)
	{
		return $this->gateway->deletePaymentMethod($token);
	}
	
	public function makePayment($billingReference, $amount, $externalId)
	{
		return $this->gateway->makePayment($billingReference, $amount, $externalId);
	}

	public function getName()
	{
		return $this->name;
	}

	public function getCurrentGateway()
	{
		return $this->gateway;
	}

	public function getResponse()
	{
		return $this->gateway->getResponse();
	}

	public function getMessage()
	{
		return $this->gateway->getMessage();
	}
}