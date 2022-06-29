<?php

declare(strict_types=1);

namespace Arokettu\Json;

final class Json
{
    public const ENCODE_DEFAULT = JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
    public const ENCODE_PRETTY  = self::ENCODE_DEFAULT | JSON_PRETTY_PRINT;

    public const DECODE_DEFAULT = JSON_THROW_ON_ERROR;

    /**
     * @param mixed $value
     * @param int|EncodeOptions $options
     * @param int $depth
     * @return string
     * @throws \JsonException
     */
    public static function encode($value, $options = self::ENCODE_DEFAULT, int $depth = 512): string
    {
        if ($options instanceof EncodeOptions) {
            $options = $options->value();
        }
        if (!\is_int($options)) {
            throw new \InvalidArgumentException('$options must be an integer or an instance of EncodeOptions');
        }

        $options |= JSON_THROW_ON_ERROR;    // force throwing exceptions

        return json_encode($value, $options, $depth);
    }

    /**
     * @param string $json
     * @param int|DecodeOptions $options
     * @param int $depth
     * @return mixed
     * @throws \JsonException
     */
    public static function decode(string $json, $options = self::DECODE_DEFAULT, int $depth = 512)
    {
        if ($options instanceof DecodeOptions) {
            $options = $options->value();
        }
        if (!\is_int($options)) {
            throw new \InvalidArgumentException('$options must be an integer or an instance of DecodeOptions');
        }

        return $options & JSON_OBJECT_AS_ARRAY ?
            self::decodeToArray($json, $options, $depth) :
            self::decodeToObject($json, $options, $depth);
    }

    /**
     * @param string $json
     * @param int|DecodeOptions $options
     * @param int $depth
     * @return mixed
     * @throws \JsonException
     */
    public static function decodeToObject(string $json, $options = self::DECODE_DEFAULT, int $depth = 512)
    {
        if ($options instanceof DecodeOptions) {
            $options = $options->value();
        }
        if (!\is_int($options)) {
            throw new \InvalidArgumentException('$options must be an integer or an instance of DecodeOptions');
        }

        $options |= JSON_THROW_ON_ERROR;    // force throwing exceptions
        $options &= ~JSON_OBJECT_AS_ARRAY;  // do not pass object as array

        $decoded = json_decode($json, null, $depth, $options);

        if (\is_array($decoded) || \is_object($decoded)) {
            $decoded = self::objectToArrayObject($decoded);
        }

        return $decoded;
    }

    /**
     * @param string $json
     * @param int|DecodeOptions $options
     * @param int $depth
     * @return mixed
     * @throws \JsonException
     */
    public static function decodeToArray(string $json, $options = self::DECODE_DEFAULT, int $depth = 512)
    {
        if ($options instanceof DecodeOptions) {
            $options = $options->value();
        }
        if (!\is_int($options)) {
            throw new \InvalidArgumentException('$options must be an integer or an instance of DecodeOptions');
        }

        $options |= JSON_THROW_ON_ERROR;    // force throwing exceptions
        $options |= JSON_OBJECT_AS_ARRAY;   // force object as array

        return json_decode($json, null, $depth, $options);
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    private static function objectToArrayObject($value)
    {
        if ($value instanceof \stdClass) {
            $value = new \ArrayObject((array) $value, \ArrayObject::ARRAY_AS_PROPS);
        }

        foreach ($value as &$v) {
            if (\is_array($v) || $v instanceof \stdClass) {
                $v = self::objectToArrayObject($v);
            }
        }

        return $value;
    }
}
