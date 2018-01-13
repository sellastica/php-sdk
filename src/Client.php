<?php
namespace Sellastica\PhpSdk;

use GuzzleHttp;
use Psr\Http\Message\ResponseInterface;
use Sellastica\PhpSdk\Exception\AbstractPhpSdkException;
use Sellastica\PhpSdk\Exception\ServerException;
use Sellastica\PhpSdk\Exception\UnexpectedResponseException;

class Client
{
	/**
	 * @var string API version
	 */
	private $version = 'v1';

	/**
	 * @var string
	 * @example http://www.myshop.com
	 */
	private $shopUrl;

	/**
	 * @var GuzzleHttp\Client
	 */
	private $guzzle;


	/**
	 * @param string $url
	 */
	public function __construct(string $url)
	{
		$this->shopUrl = rtrim($url, '/');
		$this->guzzle = new GuzzleHttp\Client();
	}

	/**
	 * @param string $name
	 * @return \Sellastica\PhpSdk\Resource\AbstractResource
	 * @throws \Sellastica\PhpSdk\Exception\InvalidResourceException
	 */
	public function __get(string $name): \Sellastica\PhpSdk\Resource\AbstractResource
	{
		$resourceClass = 'Sellastica\PhpSdk\Resource\\' . ucfirst($name);
		if (class_exists($resourceClass)) {
			$resource = new $resourceClass($this);
			return $resource;
		}

		$trace = debug_backtrace();
		throw new \Sellastica\PhpSdk\Exception\InvalidResourceException(sprintf(
			'Resource "%s" does not exist in %s on line %s',
			$name,
			$trace[0]['file'],
			$trace[0]['line']
		));
	}

	/**
	 * @param $uri
	 * @param array $options
	 * @param array|null $fields
	 * @return Response
	 */
	public function get(string $uri, array $options = [], array $fields = []): Response
	{
		if (!empty($fields)) {
			$options = array_merge($options, ['fields' => implode(',', $fields)]);
		}

		return $this->request($uri, 'GET', $options);
	}

	/**
	 * @param string $uri
	 * @param array $data
	 * @return Response
	 */
	public function post($uri, array $data = []): Response
	{
		return $this->request($uri, 'POST', $data);
	}

	/**
	 * @param string $uri
	 * @param array $data
	 * @return Response
	 */
	public function put($uri, array $data = []): Response
	{
		return $this->request($uri, 'PUT', $data);
	}

	/**
	 * @param string $uri
	 * @param array $data
	 * @return Response
	 */
	public function delete($uri, array $data = []): Response
	{
		return $this->request($uri, 'DELETE', $data);
	}

	/**
	 * @param string $uri
	 * @param string $method
	 * @param array $data
	 * @return Response
	 * @throws AbstractPhpSdkException
	 */
	private function request(string $uri, string $method, array $data = []): Response
	{
		$url = $this->shopUrl . '/api/' . $this->version . '/' . $uri . '.json';
		if ($method === 'GET' && !empty($data)) {
			$url .= '?' . http_build_query($data);
			$data = [];
		}

		if (!empty($data)) {
			$data = ['json' => $data];
		}

		try {
			/** @var ResponseInterface $response */
			$response = $this->guzzle->{$method}($url, $data);
		} catch (GuzzleHttp\Exception\ClientException $e) { //error code 4xx
			$response = $e->getResponse();
		} catch (GuzzleHttp\Exception\ServerException $e) {
			$message = $e->getResponse() && $e->getResponse()->getBody()
				? (string)$e->getResponse()->getBody()
				: $e->getMessage();
			throw new ServerException($message, $e->getResponse()->getStatusCode(), $e); //error code 5xx
		} catch (GuzzleHttp\Exception\GuzzleException $e) {
			throw new UnexpectedResponseException($e->getMessage(), $e->getCode(), $e);
		}

		$body = \Nette\Utils\Json::decode($response->getBody(), \Nette\Utils\Json::FORCE_ARRAY);
		return new \Sellastica\PhpSdk\Response($body['meta_data'], $body['data'] ?? []);
	}
}