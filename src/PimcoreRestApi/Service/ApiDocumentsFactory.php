<?php
namespace PimcoreRestApi\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApiDocumentsFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new ApiDocuments(
			$serviceLocator->get('PimcoreRestApi\Api')
		);
	}
}