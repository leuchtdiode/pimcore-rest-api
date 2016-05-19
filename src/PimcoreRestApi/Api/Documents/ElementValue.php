<?php
namespace PimcoreRestApi\Api\Documents;

class ElementValue
{
	/**
	 * @var string|null
	 */
	private $text;

	/**
	 * @return null|string
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param null|string $text
	 */
	public function setText($text)
	{
		$this->text = $text;
	}
}