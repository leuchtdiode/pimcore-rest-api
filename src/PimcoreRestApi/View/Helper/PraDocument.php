<?php
namespace PimcoreRestApi\View\Helper;

use PimcoreRestApi\Service\Documents as DocumentsService;
use Zend\View\Helper\AbstractHelper;

class PraDocument extends AbstractHelper
{
	/**
	 * @var DocumentsService
	 */
	private $documentService;

	/**
	 * @param DocumentsService $documentService
	 */
	public function __construct(DocumentsService $documentService)
	{
		$this->documentService = $documentService;
	}

	public function __invoke()
	{
		return $this;
	}

	public function printTextForPath($path)
	{
		try
		{
			$document = $this->getDocumentByPathOrFail($path);

			$wysiwygElements = $this->getElementsByType($document, 'wysiwyg');

			return $this->concatElementsText($wysiwygElements);
		}
		catch (Exception $ex)
		{
			error_log($ex->getMessage());
		}
		
		return null;
	}

	private function getDocumentByPathOrFail($path)
	{
		return $this->documentService->getByPath($path);
	}

	private function getElementsByType(
		$document,
		$type
	)
	{
		$elements = $document->getElements();

		$typeElements = [ ];

		if ($elements)
		{
			foreach ($elements as $element)
			{
				if ($element->getType() == $type && $element->getValue()->getText())
				{
					$typeElements[] = $element;
				}
			}
		}

		return $typeElements;
	}

	private function concatElementsText($wysiwygElements)
	{
		$text = '';

		foreach ($wysiwygElements as $element)
		{
			$text .= $element->getValue()->getText();
		}

		return $text;
	}
}