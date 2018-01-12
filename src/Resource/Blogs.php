<?php
namespace Sellastica\PhpSdk\Resource;

class Blogs extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'blogs';
	}
}