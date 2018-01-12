<?php
namespace Sellastica\PhpSdk\Resource;

class Collections extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'collections';
	}
}