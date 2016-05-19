<?php
namespace PimcoreRestApi\Api\Documents;

use PimcoreRestApi\Api\BaseResponse;

class SearchResponse extends BaseResponse
{
	/**
	 * @var ObjectInfo[]|null
	 */
	private $data;

	/**
	 * @return null|ObjectInfo[]
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param null|ObjectInfo[] $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}
}