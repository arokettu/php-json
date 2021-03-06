# JSON

[![Packagist](https://img.shields.io/packagist/v/arokettu/json.svg)](https://packagist.org/packages/arokettu/json)
[![Packagist](https://img.shields.io/packagist/l/arokettu/json.svg)](https://opensource.org/licenses/MIT)
[![Travis](https://img.shields.io/travis/arokettu/php-json.svg)](https://travis-ci.org/arokettu/php-json)

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

## Support

Please file issues on our main repo at GitLab: <https://gitlab.com/sandfox/php-json/-/issues>

## License

The library is available as open source under the terms of the [MIT License].

[MIT License]:  https://opensource.org/licenses/MIT
