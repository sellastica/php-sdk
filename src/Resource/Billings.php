<?php
namespace Sellastica\PhpSdk\Resource;

class Billings extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'billings';
	}
}