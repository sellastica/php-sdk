<?php
namespace Sellastica\PhpSdk\Resource;

class Pricelists extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'pricelists';
	}
}