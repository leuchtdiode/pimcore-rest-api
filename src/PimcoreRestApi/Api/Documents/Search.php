<?php
namespace PimcoreRestApi\Api\Documents;

use PimcoreRestApi\Api\BaseCall;

class Search extends BaseCall
{
	private $condition;

	private $order;

	private $orderKey;

	private $offset;

	private $limit;

	private $groupBy;

	public function getUrl()
	{
		return 'document-list';
	}

	public function getParameters()
	{
		return [
			'condition' => $this->condition,
			'order'     => $this->order,
			'orderKey'  => $this->orderKey,
			'offset'    => $this->offset,
			'limit'     => $this->limit,
			'groupBy'   => $this->groupBy,
		];
	}

	public function getResponseObject()
	{
		return new SearchResponse();
	}

	/**
	 * @param mixed $condition
	 * @return Search
	 */
	public function condition($condition)
	{
		$this->condition = $condition;

		return $this;
	}

	/**
	 * @param mixed $order
	 * @return Search
	 */
	public function order($order)
	{
		$this->order = $order;

		return $this;
	}

	/**
	 * @param mixed $orderKey
	 * @return Search
	 */
	public function orderKey($orderKey)
	{
		$this->orderKey = $orderKey;

		return $this;
	}

	/**
	 * @param mixed $offset
	 * @return Search
	 */
	public function offset($offset)
	{
		$this->offset = $offset;

		return $this;
	}

	/**
	 * @param mixed $limit
	 * @return Search
	 */
	public function limit($limit)
	{
		$this->limit = $limit;

		return $this;
	}

	/**
	 * @param mixed $groupBy
	 * @return Search
	 */
	public function groupBy($groupBy)
	{
		$this->groupBy = $groupBy;

		return $this;
	}
}