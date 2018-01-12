<?php
namespace Sellastica\PhpSdk\Resource;

class Stores extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'stores';
	}
}