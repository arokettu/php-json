# JSON

[![Packagist](https://img.shields.io/packagist/v/arokettu/json.svg?style=flat-square)](https://packagist.org/packages/arokettu/json)
[![Packagist](https://img.shields.io/packagist/l/arokettu/json.svg?style=flat-square)](https://opensource.org/licenses/MIT)
[![Gitlab pipeline status](https://img.shields.io/gitlab/pipeline/sandfox/php-json/master.svg?style=flat-square)](https://gitlab.com/sandfox/php-json/-/pipelines)
[![Codecov](https://img.shields.io/codecov/c/gl/sandfox/php-json?style=flat-square)](https://codecov.io/gl/sandfox/php-json/)

A wrapper for the standard ext-json with sane defaults

## Features

### Decoding wrapper

Decoding wrapper is the main purpose of the library.
It's killer feature is that JSON objects become instances of ArrayObject instead of stdClass.
This both keeps array/object types of the original and allows to work with all data as with arrays.

```php
<?php

$obj = \Arokettu\Json\Json::decode('{"abc": 123}');

// we can access any data array-style
var_dump($obj['abc']);
// or object-style
var_dump($obj->abc);

// object will not turn into array
echo \Arokettu\Json\Json::encode($obj);
```

### Options objects

OOP interface for json flags: ``EncodeOptions``, ``DecodeOptions``, ``ValidateOptions``

```php
<?php

use Arokettu\Json\EncodeOptions;

// set options with methods
$options = EncodeOptions::build()
    ->withThrowOnError()
    ->withHexAmp();
// set options with PHP 8 named params (both camel case and snake case names can be used)
$options = EncodeOptions::build(
    throw_on_error: true,   // apply JSON_THROW_ON_ERROR 
    hexAmp: true,           // apply JSON_HEX_AMP 
);
// use both with this library and with the base function
$value = \Arokettu\Json\Json::encode($json, $options);
$value = json_encode($json, $options->value()); 
// pretty print existing options mix
echo EncodeOptions::build(4194752)->toString();
// will get you 'JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT'
```

## Installation

```sh 
composer require 'arokettu/json'
```

## Documentation

Read full documentation here: <https://sandfox.dev/php/json.html>

Also on Read the Docs: <https://arokettu-json.readthedocs.io/>

## Support

Please file issues on our main repo at GitLab: <https://gitlab.com/sandfox/php-json/-/issues>

## License

The library is available as open source under the terms of the [MIT License].

[MIT License]:  https://opensource.org/licenses/MIT
