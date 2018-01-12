<?php
namespace Sellastica\PhpSdk\Resource;

class Categories extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'categories';
	}
}