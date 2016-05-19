<?php
namespace PimcoreRestApi\Service;

interface Documents
{
	public function getById($documentId);

	public function getByPath($documentPath);

	public function getAllByPath($path);
}