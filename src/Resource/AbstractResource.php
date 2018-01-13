<?php
namespace Sellastica\PhpSdk\Resource;

use Sellastica\PhpSdk\Client;
use Sellastica\PhpSdk\Exception\InvalidRequestException;

abstract class AbstractResource
{
	const DEFAULT_LIMIT = 50;

	/**
	 * @var \Sellastica\PhpSdk\Client
	 */
	private $client;


	/**
	 * @param \Sellastica\PhpSdk\Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @param int $id
	 * @param array|null $fields
	 * @return \Sellastica\PhpSdk\Response
	 */
	public function find(int $id, array $fields = null): \Sellastica\PhpSdk\Response
	{
		return $this->client->get(
			$this->getEndpoint() . '/' . $id,
			[],
			$this->validateFields($fields ?? [])
		);
	}

	/**
	 * @param array $options Search condition, empty = all objects
	 * @param array|null $fields Object fields to be displayed, null = all
	 * @return \Sellastica\PhpSdk\Response
	 */
	public function findOneBy(array $options, array $fields = null): \Sellastica\PhpSdk\Response
	{
		$options = $options + ['limit' => 1];
		return $this->client->get(
			$this->getEndpoint(),
			$options,
			$this->validateFields($fields ?? [])
		);
	}

	/**
	 * @param array $options Search condition, empty = all objects
	 * @param array|null $fields Object fields to be displayed, null = all
	 * @param int $page
	 * @param int $limit
	 * @return \Sellastica\PhpSdk\Response
	 */
	public function findBy(
		array $options,
		array $fields = null,
		int $page = 1,
		int $limit = self::DEFAULT_LIMIT
	): \Sellastica\PhpSdk\Response
	{
		return $this->client->get(
			$this->getEndpoint(),
			array_merge($options, [
				'page' => $page,
				'limit' => $limit,
			]),
			$this->validateFields($fields ?? [])
		);
	}

	/**
	 * @param array|null $fields
	 * @param int $page
	 * @param int $limit
	 * @return \Sellastica\PhpSdk\Response
	 */
	public function all(
		array $fields = null,
		int $page = 1,
		int $limit = self::DEFAULT_LIMIT
	): \Sellastica\PhpSdk\Response
	{
		return self::findBy([], $fields, $page, $limit);
	}

	/**
	 * @param array $options
	 * @return int
	 */
	public function count(array $options = []): int
	{
		$response = $this->client->get($this->getEndpoint() . '/count', $options);
		return $response->data['count'];
	}

	/**
	 * @param array $data
	 * @return \Sellastica\PhpSdk\Response
	 * @throws \Sellastica\PhpSdk\Exception\InvalidRequestException
	 */
	public function create(array $data): \Sellastica\PhpSdk\Response
	{
		if (isset($data['id'])) {
			throw new InvalidRequestException('Created object must not have an ID');
		}

		return $this->client->post($this->getEndpoint(), ['data' => $data]);
	}

	/**
	 * @param int $id
	 * @param array $data
	 * @return \Sellastica\PhpSdk\Response
	 */
	public function update(int $id, array $data): \Sellastica\PhpSdk\Response
	{
		if (!isset($data['id'])) {
			$data['id'] = $id;
		}

		return $this->client->put($this->getEndpoint() . '/' . $id, ['data' => $data]);
	}

	/**
	 * @param int $id
	 * @return \Sellastica\PhpSdk\Response
	 */
	public function delete(int $id): \Sellastica\PhpSdk\Response
	{
		return $this->client->delete($this->getEndpoint() . '/' . $id);
	}

	/**
	 * @param array $fields
	 * @return array
	 */
	private function validateFields(?array $fields): array
	{
		return isset($fields)
			? array_filter(array_unique($fields))
			: [];
	}

	/**
	 * Endpoint URI
	 * @return string
	 * @example customers, products, ...
	 */
	abstract public function getEndpoint();
}