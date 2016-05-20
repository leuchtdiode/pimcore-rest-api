# pimcore (REST API) module for Zend Framework 2

Zend Framework 2 module for accessing [pimcore](https://github.com/pimcore/pimcore) via its REST API.

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```sh
php composer.phar require leuchtdiode/pimcore-rest-api
```

Then add `PimcoreRestApi` to your `config/application.config.php`.

## Usage

Currently there are the following features included:

  - Retrieve document by ID
  - Retrieve document by its path
  - Search documents
  - A view helper to print freetext of a document

### Set up

In order to use the API, you have to specify a config set `pimcoreRestApi` somewhere in your application (e.g. `config/autoload/local.php`)

You have to set the following parameters:

  - `host`: The host where your pimcore API resides (e.g. cms.company.com)
  - `ssl`: Defaults to false. Setting it to true will request API through SSL. (e.g. https://cms.company.com)
  - `apiKey`: The API-Key you generated in pimcore for your user

For example:

```php
<?php
$config = [
	...
	'pimcoreRestApi' => [
		'host'		=> 'cms.company.com',
		'ssl'		=> false,
		'apiKey'	=> '1233298asd89as9das89d9as9d8as89da9sd98as9dad',
	],
	...
];
```
  
### Services

We are suggesting not to use the API directly, but the services the module is providing through service locator. At the moment there is only a document service included.

You can use `PimcoreRestApi\Service\Documents` from service locator for retrieving documents:

  - Get one document by ID `getById($documentId)`
  - Get one document by path `getByPath($documentPath)`
  - Get all documents by path `getAllByPath($path)`

## View helpers

The module is also providing a view helper for displaying freetext of a given document path.

### PraDocument

By calling `$this->praDocument()` in your view you can get an instance of the document view helper which provides the following methods at the moment:

#### Print text for path

`$this->praDocument()->printTextForPath($path)`

This method tries to fetch a document by its path, searching for all of its WYSIWYG elements, concatenates them and outputs the text. `null` gets returned if there was a problem fetching the document or finding WYSIWYG elements.

## Caching

To minimize the API calls to the external pimcore system via its REST API we are suggesting setting up a storage cache provided by [zend-cache](https://github.com/zendframework/zend-cache).

The module has already implemented caching. You only have to tell him.

Setting up is as simple as defining a factory in service locator which is returning a `Zend\Cache\Storage\StorageInterface` for key `PimcoreRestApi\StorageCache`,
