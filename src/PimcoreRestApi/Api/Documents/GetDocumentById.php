<?php
namespace PimcoreRestApi\Api\Documents;

use PimcoreRestApi\Api\BaseCall;
use PimcoreRestApi\Api\Call;

class GetDocumentById extends BaseCall
{
	private $documentId;

	/**
	 * @param mixed $documentId
	 * @return GetDocumentById
	 */
	public function documentId($documentId)
	{
		$this->documentId = $documentId;

		return $this;
	}

	public function getUrl()
	{
		return 'document/id/' . $this->documentId;
	}

	public function getParameters()
	{
		return null;
	}

	public function getResponseObject()
	{
		return new GetDocumentByIdResponse();
	}
}