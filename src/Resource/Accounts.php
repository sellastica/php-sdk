<?php
namespace Sellastica\PhpSdk\Resource;

class Accounts extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'accounts';
	}
}