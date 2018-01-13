<?php
namespace Sellastica\PhpSdk;

class Response
{
	/**
	 * @var array
	 */
	public $metadata;

	/**
	 * @var int
	 */
	public $statusCode;

	/**
	 * @var string
	 */
	public $message;

	/**
	 * @var array
	 */
	public $data;


	/**
	 * @param array $metadata
	 * @param array $data
	 */
	public function __construct(array $metadata, array $data = [])
	{
		$this->metadata = $metadata;
		$this->statusCode = $metadata['status_code'];
		$this->message = $metadata['message'];
		$this->data = $data;

	}
}