# Changelog

## 2.x

### 2.1.0

*Dec 4, 2023*

* Added `stdClassToArray()`

### 2.0.0

*Dec 4, 2023*

Forked from 1.4.0

* PHP 8.0 is required
* Removed camel case arguments to `build()` methods
* Exposed `stdClassToArrayObject()` to public

## 1.x

### 1.4.0

*Jun 6, 2023*

* Using wrong type for options now generates `TypeError` instead of `InvalidArgumentException`
* Added `ValidateOptions`
* Added `Json::validate()` for `json_validate` that falls back to the Symfony's polyfill implementation
* Fixed `*Options->toString()` returning empty string for no options instead of `'0'`

### 1.3.0

*Jun 29, 2022*

* `ArrayObject`s are now constructed with `ARRAY_AS_PROPS` enabled

### 1.2.1

*May 19, 2021*

* Optimize decoding to array for `Json::decode()` a bit
* Include `JSON_THROW_ON_ERROR` into
  `Json::ENCODE_DEFAULT` /
  `Json::ENCODE_PRETTY` /
  `Json::DECODE_DEFAULT`
  for consistency with `*Options` objects
  (no logic change here because throwing exceptions is enforced by the methods)

### 1.2.0

*May 13, 2021*

* `DecodeOptions` and `EncodeOptions`

### 1.1.0

*Aug 29, 2020*

* Allow passing `JSON_OBJECT_AS_ARRAY` to `decode()`
* Add two wrapper methods: `decodeToArray()` and `decodeToObject()`

### 1.0.0

*Jul 27, 2020*

Initial release
