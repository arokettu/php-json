JSON Wrapper
############

.. highlight:: php

Encoding
========

::

    <?php

    function \Arokettu\Json\Json::encode(
        mixed $value,
        int|\Arokettu\Json\EncodeOptions $options =
            JSON_THROW_ON_ERROR |
            JSON_UNESCAPED_SLASHES |
            JSON_UNESCAPED_UNICODE,
        int $depth = 512,
    ): string;

Main features:

* ``JSON_THROW_ON_ERROR`` is enforced
* Two convenience constants::

        <?php

        const \Arokettu\Json\Json::ENCODE_DEFAULT =
            JSON_THROW_ON_ERROR |
            JSON_UNESCAPED_SLASHES |
            JSON_UNESCAPED_UNICODE;
        const \Arokettu\Json\Json::ENCODE_PRETTY =
            JSON_THROW_ON_ERROR |
            JSON_UNESCAPED_SLASHES |
            JSON_UNESCAPED_UNICODE |
            JSON_PRETTY_PRINT;

Decoding
========

.. versionchanged:: 1.3.0 ``ArrayObject`` now has ``ARRAY_AS_PROPS`` enabled

::

    <?php

    function \Arokettu\Json\Json::decode(
        string $json,
        int|\Arokettu\Json\DecodeOptions $options = JSON_THROW_ON_ERROR,
        int $depth = 512,
    ): mixed;

Main features:

* ``JSON_THROW_ON_ERROR`` is enforced
* Pass ``JSON_OBJECT_AS_ARRAY`` to get associative arrays
* JSON objects are decoded to instances of ``ArrayObject`` instead of ``stdClass`` when parsed as objects

Force decoding objects as associative arrays::

    <?php

    function \Arokettu\Json\Json::decodeToArray(
        string $json,
        int|\Arokettu\Json\DecodeOptions $options = JSON_THROW_ON_ERROR,
        int $depth = 512,
    ): mixed;

Force decoding objects as instances of ``ArrayObject``::

    <?php

    function \Arokettu\Json\Json::decodeToObject(
        string $json,
        int|\Arokettu\Json\DecodeOptions int $options = JSON_THROW_ON_ERROR,
        int $depth = 512,
    ): mixed;

Post-processor
==============

.. versionadded:: 2.0 Exposed to public

If you have a library that does json decoding internally
and you just want to post-process its output from stdClass to ArrayObject or array::

    <?php

    function \Arokettu\Json\Json::stdClassToArrayObject(
        mixed $value,
    ): mixed;

    function \Arokettu\Json\Json::stdClassToArray(
        mixed $value,
    ): mixed;

Example::

    <?php

    use Arokettu\Json\Json;

    $internallyDecoded = json_decode('{"a": 123}'); // output from some lib
    var_dump($internallyDecoded->a); // 123
    var_dump($internallyDecoded['a']); // Error!
    $decoded = Json::stdClassToArrayObject($internallyDecoded);
    var_dump($decoded['a']); // 123
