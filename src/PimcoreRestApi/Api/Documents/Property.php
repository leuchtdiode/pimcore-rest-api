<?php
namespace PimcoreRestApi\Api\Documents;

class Property
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var mixed|null
	 */
	private $data;

	/**
	 * @return mixed
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * @param mixed|null $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}
}