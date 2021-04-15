# JSON

[![Packagist](https://img.shields.io/packagist/v/arokettu/json.svg?style=flat-square)](https://packagist.org/packages/arokettu/json)
[![Packagist](https://img.shields.io/packagist/l/arokettu/json.svg?style=flat-square)](https://opensource.org/licenses/MIT)
[![Gitlab pipeline status](https://img.shields.io/gitlab/pipeline/sandfox/php-json/master.svg?style=flat-square)](https://gitlab.com/sandfox/php-json/-/pipelines)
[![Codecov](https://img.shields.io/codecov/c/gl/sandfox/php-json?style=flat-square)](https://codecov.io/gl/sandfox/php-json/)


A wrapper for the standard ext-json with sane defaults

Decoding wrapper is the main purpose of the library.
It's killer feature is that JSON objects become instances of ArrayObject instead of stdClass.
This both keeps array/object types of the original and allows to work with all data as with arrays.

```php
<?php

$obj = \Arokettu\Json\Json::decode('{"abc": 123}');

// we can access any data array-style
unset($obj['abc']);

// object will not turn into array
echo \Arokettu\Json\Json::encode($obj);
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
