<?php

declare(strict_types=1);

namespace Arokettu\Json;

final class Json
{
    public const ENCODE_DEFAULT = \JSON_THROW_ON_ERROR | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE;
    public const ENCODE_PRETTY  = self::ENCODE_DEFAULT | \JSON_PRETTY_PRINT;

    public const DECODE_DEFAULT = \JSON_THROW_ON_ERROR;

    public const VALIDATE_DEFAULT = 0;

    /**
     * @throws \JsonException
     */
    public static function encode(
        mixed $value,
        int|EncodeOptions $options = self::ENCODE_DEFAULT,
        int $depth = 512
    ): string {
        if ($options instanceof EncodeOptions) {
            $options = $options->value();
        }

        $options |= \JSON_THROW_ON_ERROR; // force throwing exceptions

        return \json_encode($value, $options, $depth);
    }

    /**
     * @throws \JsonException
     */
    public static function decode(
        string $json,
        int|DecodeOptions $options = self::DECODE_DEFAULT,
        int $depth = 512,
    ): mixed {
        if ($options instanceof DecodeOptions) {
            $options = $options->value();
        }

        return $options & \JSON_OBJECT_AS_ARRAY ?
            self::decodeToArray($json, $options, $depth) :
            self::decodeToObject($json, $options, $depth);
    }

    /**
     * @throws \JsonException
     */
    public static function decodeToObject(
        string $json,
        int|DecodeOptions $options = self::DECODE_DEFAULT,
        int $depth = 512,
    ): mixed {
        if ($options instanceof DecodeOptions) {
            $options = $options->value();
        }

        $options |= \JSON_THROW_ON_ERROR;    // force throwing exceptions
        $options &= ~\JSON_OBJECT_AS_ARRAY;  // do not pass object as array

        $decoded = \json_decode($json, null, $depth, $options);

        if (\is_array($decoded) || \is_object($decoded)) {
            $decoded = self::stdClassToArrayObject($decoded);
        }

        return $decoded;
    }

    /**
     * @throws \JsonException
     */
    public static function decodeToArray(
        string $json,
        int|DecodeOptions $options = self::DECODE_DEFAULT,
        int $depth = 512
    ): mixed {
        if ($options instanceof DecodeOptions) {
            $options = $options->value();
        }

        $options |= \JSON_THROW_ON_ERROR;    // force throwing exceptions
        $options |= \JSON_OBJECT_AS_ARRAY;   // force object as array

        return \json_decode($json, null, $depth, $options);
    }

    public static function validate(
        string $json,
        int|ValidateOptions $options = self::VALIDATE_DEFAULT,
        int $depth = 512,
    ): bool {
        if ($options instanceof ValidateOptions) {
            $options = $options->value();
        }

        return \json_validate($json, $depth, $options);
    }

    public static function stdClassToArrayObject(mixed $value): mixed
    {
        if ($value instanceof \stdClass) {
            $value = new \ArrayObject(\get_object_vars($value), \ArrayObject::ARRAY_AS_PROPS);
        }

        foreach ($value as &$v) {
            if (\is_array($v) || $v instanceof \stdClass) {
                $v = self::stdClassToArrayObject($v);
            }
        }

        return $value;
    }
}
