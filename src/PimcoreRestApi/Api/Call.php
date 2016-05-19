<?php
namespace PimcoreRestApi\Api;

interface Call
{
	public function getUrl();

	public function getParameters();

	public function getResponseObject();
}