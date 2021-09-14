JSON Wrapper
############

Encoding
========

.. code-block:: php

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
* Two convenience constants:
    .. code-block:: php

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

.. code-block:: php

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

Force decoding objects as associative arrays:

.. code-block:: php

    <?php

    function \Arokettu\Json\Json::decodeToArray(
        string $json,
        int|\Arokettu\Json\DecodeOptions $options = JSON_THROW_ON_ERROR,
        int $depth = 512,
    ): mixed;

Force decoding objects as instances of ``ArrayObject``:

.. code-block:: php

    <?php

    function \Arokettu\Json\Json::decodeToObject(
        string $json,
        int|\Arokettu\Json\DecodeOptions int $options = JSON_THROW_ON_ERROR,
        int $depth = 512,
    ): mixed;
