<?php

namespace App\Libraries\PaymentGateway;

abstract class BaseGateway
{

	/**
	 * The gateway object we will be using
	 */
	protected $paymentGateway;

	/**
	 * The name of current gateway name
	 */
	protected $gatewayName;

	/**
	 * The response result when we make a call to the gateway
	 */
	protected $response;
	/**
	 * @string a custom success message
	 */
	protected $successMsg;

	/**
	 * @string a custom error message
	 */
	protected $failMsg;

	/**
	 * The Customer retrieved from our payment gateway
	 */
	protected $customerFields =  [
		'id',
		'first_name',
		'last_name',
		'company',
		'contact_phone',
		'contact_email',
		'phone'
	];

	protected $paymentProfileFields = [
		'expiration_month',
		'expiration_year',
		'last_four',
		'type',
		'address_name',
		'expiration_date',
		'billing_reference',
		'customer_id',
		'address_street',
		'address_city',
		'address_state',
		'address_zip',
		'address_country_code',
		'address_country_name',
		'cc_masked_number'
	];

	public function __construct($name)
	{
		$this->paymentGateway = $name;
	}

	/**
	 * Return the response
	 * @return bool
	 */
	public function getResponse()
	{
		return $this->response;
	}

	/**
	 * Return the name of current gateway
	 * @return string 
	 */
	public function getName()
	{
		return $this->gatewayName;
	}

	/**
	 * @return string message related to the response
	 */
	public function getMessage()
	{
		$msg = $this->response ? $this->getSuccessMessage() : $this->getFailMessage();
		return $msg;
	}

	/**
	  *	Get the failure message 
	  * @return string 
	  */
	protected function getFailMessage(){
		return sprintf($this->failMsg, $this->paymentGateway);
	}
	/**
	  *	Get the Success message 
	  * @return string 
	  */
	protected function getSuccessMessage(){
		return sprintf($this->successMsg, $this->paymentGatey);
	}

	/**
	 * Return only selected fields
	 * @param array $data
	 * @return array
	 */
	public function customerFields($data)
	{
		foreach ($data as $key => $value) {
			if(!in_array($key, $this->customerFields)){
				unset($data[$key]);
			}
		}
		return $data;
	}

	/**
	 * Return only selected fields
	 * @param array $data
	 * @return array
	 */
	public function paymentProfileFields($data)
	{
		foreach ($data as $key => $value) {
			if(!in_array($key, $this->paymentProfileFields)){
				unset($data[$key]);
			}
		}
		return $data;
	}
}