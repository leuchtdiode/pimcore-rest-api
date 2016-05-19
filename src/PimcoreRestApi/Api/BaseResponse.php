<?php
namespace PimcoreRestApi\Api;

abstract class BaseResponse
{
	/**
	 * @var boolean
	 */
	private $success;

	/**
	 * @return boolean
	 */
	public function isSuccess()
	{
		return $this->success;
	}

	/**
	 * @param boolean $success
	 */
	public function setSuccess($success)
	{
		$this->success = $success;
	}
}