<?php
namespace Sellastica\PhpSdk\Resource;

class Shippings extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'shippings';
	}
}