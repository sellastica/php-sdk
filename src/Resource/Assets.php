<?php
namespace Sellastica\PhpSdk\Resource;

class Assets extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'assets';
	}
}