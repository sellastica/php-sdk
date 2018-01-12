<?php
namespace Sellastica\PhpSdk\Resource;

class Suppliers extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'suppliers';
	}
}