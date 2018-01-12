<?php
namespace Sellastica\PhpSdk;

class Response
{
	/**
	 * @var array
	 */
	private $metadata;

	/**
	 * @var array
	 */
	private $data = [];


	/**
	 * @param array $metadata
	 */
	public function __construct(
		array $metadata
	)
	{
		$this->metadata = $metadata;
	}

	/**
	 * @return int
	 */
	public function getStatusCode(): int
	{
		return $this->metadata['status_code'];
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->metadata['message'];
	}

	/**
	 * @return array
	 */
	public function getMetadata(): array
	{
		return $this->metadata;
	}

	/**
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}

	/**
	 * @param array $data
	 */
	public function setData(array $data): void
	{
		$this->data = $data;
	}
}