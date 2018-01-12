<?php
namespace Sellastica\PhpSdk\Resource;

class Pages extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'pages';
	}
}