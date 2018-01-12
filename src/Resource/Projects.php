<?php
namespace Sellastica\PhpSdk\Resource;

class Projects extends AbstractResource
{
	/**
	 * @return string
	 */
	public function getEndpoint(): string
	{
		return 'projects';
	}
}