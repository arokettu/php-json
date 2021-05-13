<?php

/**
 * This class is autogenerated by sbin/generate_options.php
 *
 * @noinspection DuplicatedCode
 * @noinspection PhpUnused
 */

declare(strict_types=1);

namespace Arokettu\Json;

final class DecodeOptions
{
    private $options;

    public static function build(
        int $options = 0,
        ?bool $bigintAsString = null,
        ?bool $objectAsArray = null,
        ?bool $invalidUtf8Ignore = null,
        ?bool $invalidUtf8Substitute = null,
        ?bool $throwOnError = null,
        ?bool $bigint_as_string = null,
        ?bool $object_as_array = null,
        ?bool $invalid_utf8_ignore = null,
        ?bool $invalid_utf8_substitute = null,
        ?bool $throw_on_error = null
    ): self {
        if ($bigintAsString !== null) {
            $options = $bigintAsString ?
                $options | JSON_BIGINT_AS_STRING :
                $options & ~JSON_BIGINT_AS_STRING;
        }
        if ($objectAsArray !== null) {
            $options = $objectAsArray ?
                $options | JSON_OBJECT_AS_ARRAY :
                $options & ~JSON_OBJECT_AS_ARRAY;
        }
        if ($invalidUtf8Ignore !== null) {
            $options = $invalidUtf8Ignore ?
                $options | JSON_INVALID_UTF8_IGNORE :
                $options & ~JSON_INVALID_UTF8_IGNORE;
        }
        if ($invalidUtf8Substitute !== null) {
            $options = $invalidUtf8Substitute ?
                $options | JSON_INVALID_UTF8_SUBSTITUTE :
                $options & ~JSON_INVALID_UTF8_SUBSTITUTE;
        }
        if ($throwOnError !== null) {
            $options = $throwOnError ?
                $options | JSON_THROW_ON_ERROR :
                $options & ~JSON_THROW_ON_ERROR;
        }
        if ($bigint_as_string !== null) {
            $options = $bigint_as_string ?
                $options | JSON_BIGINT_AS_STRING :
                $options & ~JSON_BIGINT_AS_STRING;
        }
        if ($object_as_array !== null) {
            $options = $object_as_array ?
                $options | JSON_OBJECT_AS_ARRAY :
                $options & ~JSON_OBJECT_AS_ARRAY;
        }
        if ($invalid_utf8_ignore !== null) {
            $options = $invalid_utf8_ignore ?
                $options | JSON_INVALID_UTF8_IGNORE :
                $options & ~JSON_INVALID_UTF8_IGNORE;
        }
        if ($invalid_utf8_substitute !== null) {
            $options = $invalid_utf8_substitute ?
                $options | JSON_INVALID_UTF8_SUBSTITUTE :
                $options & ~JSON_INVALID_UTF8_SUBSTITUTE;
        }
        if ($throw_on_error !== null) {
            $options = $throw_on_error ?
                $options | JSON_THROW_ON_ERROR :
                $options & ~JSON_THROW_ON_ERROR;
        }
        return new self($options);
    }

    public static function default(): self
    {
        return new self(JSON_THROW_ON_ERROR);
    }

    public static function asArray(): self
    {
        return new self(JSON_THROW_ON_ERROR | JSON_OBJECT_AS_ARRAY);
    }

    public function __construct(int $options)
    {
        $this->options = $options;
    }

    public function value(): int
    {
        return $this->options;
    }

    public function toInt(): int
    {
        return $this->options;
    }

    public function toString(): string
    {
        $constants = [];
        if ($this->options & JSON_BIGINT_AS_STRING) {
            $constants[] = 'JSON_BIGINT_AS_STRING';
        }
        if ($this->options & JSON_OBJECT_AS_ARRAY) {
            $constants[] = 'JSON_OBJECT_AS_ARRAY';
        }
        if ($this->options & JSON_INVALID_UTF8_IGNORE) {
            $constants[] = 'JSON_INVALID_UTF8_IGNORE';
        }
        if ($this->options & JSON_INVALID_UTF8_SUBSTITUTE) {
            $constants[] = 'JSON_INVALID_UTF8_SUBSTITUTE';
        }
        if ($this->options & JSON_THROW_ON_ERROR) {
            $constants[] = 'JSON_THROW_ON_ERROR';
        }
        return implode(' | ', $constants);
    }

    public function withBigintAsString(): self
    {
        return new self($this->options | JSON_BIGINT_AS_STRING);
    }

    public function withoutBigintAsString(): self
    {
        return new self($this->options & ~JSON_BIGINT_AS_STRING);
    }

    public function withObjectAsArray(): self
    {
        return new self($this->options | JSON_OBJECT_AS_ARRAY);
    }

    public function withoutObjectAsArray(): self
    {
        return new self($this->options & ~JSON_OBJECT_AS_ARRAY);
    }

    public function withInvalidUtf8Ignore(): self
    {
        return new self($this->options | JSON_INVALID_UTF8_IGNORE);
    }

    public function withoutInvalidUtf8Ignore(): self
    {
        return new self($this->options & ~JSON_INVALID_UTF8_IGNORE);
    }

    public function withInvalidUtf8Substitute(): self
    {
        return new self($this->options | JSON_INVALID_UTF8_SUBSTITUTE);
    }

    public function withoutInvalidUtf8Substitute(): self
    {
        return new self($this->options & ~JSON_INVALID_UTF8_SUBSTITUTE);
    }

    public function withThrowOnError(): self
    {
        return new self($this->options | JSON_THROW_ON_ERROR);
    }

    public function withoutThrowOnError(): self
    {
        return new self($this->options & ~JSON_THROW_ON_ERROR);
    }
}
