JSON
####

|Packagist| |GitLab| |GitHub| |Bitbucket| |Gitea|

A wrapper for the standard ext-json with sane defaults.

Installation
============

.. code-block:: bash

    composer require 'arokettu/json'

Encoding
========

.. code-block:: php

    <?php
    function \Arokettu\Json\Json::encode(mixed $value, int $options = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE, int $depth = 512): string;

Main features:

* ``JSON_THROW_ON_ERROR`` is enforced
* Two convenience constants:

    * ``\Arokettu\Json\Json::ENCODE_DEFAULT = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE``
    * ``\Arokettu\Json\Json::ENCODE_PRETTY = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT``

Decoding
========

.. code-block:: php

    <?php
    function \Arokettu\Json\Json::decode(string $json, int $options = 0, int $depth = 512): mixed;

Main features:

* ``JSON_THROW_ON_ERROR`` is enforced
* Pass ``JSON_OBJECT_AS_ARRAY`` to get associative arrays
* JSON objects are decoded to instances of ``ArrayObject`` instead of ``stdClass`` when parsed as objects

.. code-block:: php

    <?php
    function \Arokettu\Json\Json::decodeToArray(string $json, int $options = 0, int $depth = 512): mixed;

Force decoding objects as associative arrays

.. code-block:: php

    <?php
    function \Arokettu\Json\Json::decodeToObject(string $json, int $options = 0, int $depth = 512): mixed;

Force decoding objects as instances of ``ArrayObject``

License
=======

The library is available as open source under the terms of the `MIT License`_.

.. _MIT License:    https://opensource.org/licenses/MIT

.. |Packagist|  image:: https://img.shields.io/packagist/v/arokettu/json.svg?style=flat-square
   :target:     https://packagist.org/packages/arokettu/json
.. |GitHub|     image:: https://img.shields.io/badge/get%20on-GitHub-informational.svg?style=flat-square&logo=github
   :target:     https://github.com/arokettu/php-json
.. |GitLab|     image:: https://img.shields.io/badge/get%20on-GitLab-informational.svg?style=flat-square&logo=gitlab
   :target:     https://gitlab.com/sandfox/php-json
.. |Bitbucket|  image:: https://img.shields.io/badge/get%20on-Bitbucket-informational.svg?style=flat-square&logo=bitbucket
   :target:     https://bitbucket.org/sandfox/php-json
.. |Gitea|      image:: https://img.shields.io/badge/get%20on-Gitea-informational.svg?style=flat-square&logo=gitea
   :target:     https://sandfox.org/sandfox/php-json
