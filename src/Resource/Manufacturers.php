<?php
namespace Sellastica\PhpSdk\Resource;

class Manufacturers extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'manufacturers';
	}
}