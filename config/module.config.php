<?php
namespace PimcoreRestApi;

return [

	'service_manager' => [
		'factories' => [

			// api
			'PimcoreRestApi\Api'               => 'PimcoreRestApi\Api\Factory',

			// service
			'PimcoreRestApi\Service\Documents' => 'PimcoreRestApi\Service\ApiDocumentsFactory',
		],
	],

	'view_helpers' => [
		'factories' => [
			'praDocument' => 'PimcoreRestApi\View\Helper\PraDocumentFactory',
		],
	],
];
