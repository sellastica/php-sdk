<?php
namespace Sellastica\PhpSdk\Resource;

class Shipments extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'shipments';
	}
}