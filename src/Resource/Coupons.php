<?php
namespace Sellastica\PhpSdk\Resource;

class Coupons extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'coupons';
	}
}