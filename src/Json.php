<?php

declare(strict_types=1);

namespace Arokettu\Json;

final class Json
{
    public const ENCODE_DEFAULT = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
    public const ENCODE_PRETTY  = self::ENCODE_DEFAULT | JSON_PRETTY_PRINT;

    public const DECODE_DEFAULT = 0;

    /**
     * @param mixed $value
     * @param int $options
     * @param int $depth
     * @return string
     * @throws \JsonException
     */
    public static function encode($value, int $options = self::ENCODE_DEFAULT, int $depth = 512): string
    {
        $options |= JSON_THROW_ON_ERROR;    // force throwing exceptions

        return json_encode($value, $options, $depth);
    }

    /**
     * @param string $json
     * @param int $options
     * @param int $depth
     * @return mixed
     * @throws \JsonException
     */
    public static function decode(string $json, int $options = self::DECODE_DEFAULT, int $depth = 512)
    {
        $options |= JSON_THROW_ON_ERROR;    // force throwing exceptions
        $options &= ~JSON_OBJECT_AS_ARRAY;  // do not pass object as array

        $decoded = json_decode($json, false, $depth, $options);

        if (is_array($decoded) || is_object($decoded)) {
            $decoded = self::objectToArrayObject($decoded);
        }

        return $decoded;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    private static function objectToArrayObject($value)
    {
        if (is_object($value)) {
            $value = new \ArrayObject((array) $value);
        }

        foreach ($value as &$v) {
            if (is_array($v) || is_object($v)) {
                $v = self::objectToArrayObject($v);
            }
        }

        return $value;
    }
}
