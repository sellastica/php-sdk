<?php
namespace Sellastica\PhpSdk\Resource;

class PaymentTransactions extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'payment_transactions';
	}
}