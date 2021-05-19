# Changelog

## 1.2.1

*May 19, 2021*

* Optimize decoding to array for `Json::decode()` a bit
* Include `JSON_THROW_ON_ERROR` into
  `Json::ENCODE_DEFAULT` /
  `Json::ENCODE_PRETTY` /
  `Json::DECODE_DEFAULT`
  for consistency with `*Options` objects
  (no logic change here because throwing exceptions is enforced by the methods)

## 1.2.0

*May 13, 2021*

* `DecodeOptions` and `EncodeOptions`

## 1.1.0

*Aug 29, 2020*

* Allow passing `JSON_OBJECT_AS_ARRAY` to `decode()`
* Add two wrapper methods: `decodeToArray()` and `decodeToObject()`

## 1.0.0

*Jul 27, 2020*

Initial release
