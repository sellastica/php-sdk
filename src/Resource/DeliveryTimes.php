<?php
namespace Sellastica\PhpSdk\Resource;

class DeliveryTimes extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'delivery_times';
	}
}