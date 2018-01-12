<?php
namespace Sellastica\PhpSdk\Resource;

class Articles extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'articles';
	}
}