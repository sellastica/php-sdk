<?php
namespace Sellastica\PhpSdk\Resource;

class Products extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'products';
	}
}