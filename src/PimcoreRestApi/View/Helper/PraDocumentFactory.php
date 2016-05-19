<?php
namespace PimcoreRestApi\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PraDocumentFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$serviceLocator = $serviceLocator->getServiceLocator();

		return new PraDocument(
			$serviceLocator->get('PimcoreRestApi\Service\Documents')
		);
	}
}