<?php
namespace PimcoreRestApi\Api\Documents;

use PimcoreRestApi\Api\BaseResponse;

class GetDocumentByIdResponse extends BaseResponse
{
	/**
	 * @var Document
	 */
	private $data;

	/**
	 * @return Document
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param Document $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}
}