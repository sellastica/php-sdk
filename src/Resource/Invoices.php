<?php
namespace Sellastica\PhpSdk\Resource;

class Invoices extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'invoices';
	}
}