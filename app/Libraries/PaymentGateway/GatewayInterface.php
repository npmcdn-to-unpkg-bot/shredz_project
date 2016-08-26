<?php 

namespace App\Libraries\PaymentGateway;

interface GatewayInterface 
{
	public function getCustomer($id);
	public function addPaymentMethod($data);
	public function createCustomer($data);
	public function updatePaymentMethod($billing_reference, array $data);
	public function deletePaymentMethod($billing_reference);
	public function makePayment($billingReference, $amount, $externalId);
}