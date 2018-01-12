<?php
namespace Sellastica\PhpSdk\Resource;

class Orders extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'orders';
	}
}