<?php
namespace PimcoreRestApi\Service;

use PimcoreRestApi\Api\Documents\GetDocumentById;
use PimcoreRestApi\Api\Documents\Search as DocumentSearch;
use PimcoreRestApi\Api\PimcoreApi;

class ApiDocuments implements Documents
{
	/**
	 * @var PimcoreApi
	 */
	private $api;

	/**
	 * @param PimcoreApi $api
	 */
	public function __construct(PimcoreApi $api)
	{
		$this->api = $api;
	}

	public function getByPath($documentPath)
	{
		$searchResponse = $this->api->call(DocumentSearch::with()
			->condition($this->makePathCondition($documentPath))
		);

		if ($searchResponse->isSuccess() && ($objectInfos = $searchResponse->getData()))
		{
			if (count($objectInfos) == 1)
			{
				return $this->getById(reset($objectInfos)->getId())->getData();
			}
		}

		throw new \Exception('Could not find one document for path ' . $documentPath);
	}

	private function makePathCondition($fullPath)
	{
		$boom = explode('/', $fullPath);

		$path = '';

		foreach ($boom as $i => $pathPart)
		{
			if ($i < count($boom) - 1)
			{
				$path .= $pathPart . '/';
			}
		}

		return sprintf(
			'`path` = \'%s\' AND `key` = \'%s\'',
			$path,
			$boom[count($boom) - 1]
		);
	}

	public function getById($documentId)
	{
		return $this->api->call(GetDocumentById::with()->documentId($documentId));
	}

	public function getAllByPath($path)
	{
		$searchResponse = $this->api->call(DocumentSearch::with()
			->condition(
				sprintf(
					'`path` = \'%s\'',
					$this->correctPath($path)
				)
			)
			->orderKey('index')
			->order('ASC')
		);

		$documents = [ ];

		if ($searchResponse->isSuccess() && ($objectInfos = $searchResponse->getData()))
		{
			if (count($objectInfos) > 0)
			{
				foreach ($objectInfos as $objectInfo)
				{
					$documents[] = $this->getById($objectInfo->getId())->getData();
				}
			}
		}

		return $documents;
	}

	private function correctPath($path)
	{
		if (substr($path, -1) != '/')
		{
			$path .= '/';
		}

		return $path;
	}
}