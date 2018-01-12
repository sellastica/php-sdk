<?php
namespace Sellastica\PhpSdk\Resource;

class Customers extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'customers';
	}
}