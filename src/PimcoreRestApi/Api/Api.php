<?php
namespace PimcoreRestApi\Api;

use Zend\Cache\Storage\StorageInterface;
use Zend\Http\Client;

class Api implements PimcoreApi
{
	/**
	 * @var Client
	 */
	private $httpClient;

	/**
	 * @var string
	 */
	private $host;

	/**
	 * @var string
	 */
	private $apiKey;

	/**
	 * @var boolean
	 */
	private $ssl = false;

	/**
	 * @var StorageInterface
	 */
	private $cacheStorage;

	/**
	 * @param Client $httpClient
	 * @param string $host
	 * @param string $apiKey
	 * @param bool $ssl
	 * @param StorageInterface $cacheStorage
	 */
	public function __construct(
		Client $httpClient,
		$host,
		$apiKey,
		$ssl = false,
		StorageInterface $cacheStorage = null
	)
	{
		$this->httpClient = $httpClient;
		$this->host = $host;
		$this->apiKey = $apiKey;
		$this->ssl = $ssl;
		$this->cacheStorage = $cacheStorage;
	}

	public function call(Call $apiCall)
	{
		$uri = $this->makeUri($apiCall);

		if ($this->cacheStorage)
		{
			$cacheId = 'pimcore_rest_api_' . md5($uri);

			if ($this->cacheStorage->hasItem($cacheId))
			{
				return $this->cacheStorage->getItem($cacheId);
			}
		}

		$this->httpClient->setUri($uri);

		try
		{
			$response = $this->httpClient->send();

			$this->failIfRequestFailed($response);

			$json = $this->getDecodedJsonOrFail($response);

			$responseObject = $this->mapJsonToResponseObject($apiCall, $json);

			if ($this->cacheStorage)
			{
				$this->cacheStorage->setItem($cacheId, $responseObject);
			}

			return $responseObject;
		}
		catch (\Exception $ex)
		{
			throw new Exception($ex->getMessage());
		}
	}

	private function makeUri(Call $apiCall)
	{
		$this->failIfParamsMissing();

		$baseUrl = sprintf(
			'%s://%s/webservice/rest/%s?apikey=%s',
			$this->ssl ? 'https' : 'http',
			$this->host,
			$apiCall->getUrl(),
			$this->apiKey
		);

		return $baseUrl . $this->addParameters($apiCall->getParameters());
	}

	private function failIfParamsMissing()
	{
		if (!$this->apiKey || !$this->host)
		{
			throw new Exception('Host and API-Key are mandatory');
		}
	}

	private function addParameters($parameters)
	{
		if (!$parameters)
		{
			return null;
		}

		$params = '';

		foreach ($parameters as $param => $value)
		{
			if ($value)
			{
				$params .= "&{$param}=" . urlencode($value);
			}
		}

		return $params;
	}

	/**
	 * @param $response
	 * @throws Exception
	 */
	private function failIfRequestFailed($response)
	{
		if ($response->getStatusCode() != 200)
		{
			throw new Exception('Request failed with status code ' . $response->getStatusCode());
		}
	}

	/**
	 * @param $response
	 * @return mixed
	 * @throws Exception
	 */
	private function getDecodedJsonOrFail($response)
	{
		$json = json_decode($response->getBody());

		if (!$json)
		{
			throw new Exception('Could not decode response');
		}

		return $json;
	}

	/**
	 * @param Call $apiCall
	 * @param $json
	 * @return mixed
	 */
	private function mapJsonToResponseObject(
		Call $apiCall,
		$json
	)
	{
		$jsonMapper = new \JsonMapper();

		$responseObject = $jsonMapper->map($json, $apiCall->getResponseObject());

		return $responseObject;
	}
}