<?php
namespace PimcoreRestApi\Api;

abstract class BaseCall implements Call
{
	/**
	 * @return BaseCall
	 */
	public static function with()
	{
		return new static();
	}
}