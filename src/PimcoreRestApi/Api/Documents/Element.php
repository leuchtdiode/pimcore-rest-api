<?php
namespace PimcoreRestApi\Api\Documents;

class Element
{
	/**
	 * @var string
	 */
	private $type;

	/**
	 * @var ElementValue
	 */
	private $value;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * @return ElementValue
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param ElementValue $value
	 */
	public function setValue($value)
	{
		$this->value = $value;
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