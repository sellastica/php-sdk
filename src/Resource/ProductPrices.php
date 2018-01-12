<?php
namespace Sellastica\PhpSdk\Resource;

class ProductPrices extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'product_prices';
	}
}