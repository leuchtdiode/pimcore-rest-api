<?php
namespace PimcoreRestApi\Api;

interface PimcoreApi
{
	/**
	 * @return BaseResponse
	 */
	public function call(Call $call);
}