<?php

declare(strict_types=1);

namespace Arokettu\Json;

final class Json
{
    /**
     * @param mixed $value
     * @param int $options
     * @param int $depth
     * @return string
     * @throws \JsonException
     */
    public static function encode($value, int $options = 0, int $depth = 512): string
    {
        return json_encode($value, $options, $depth);
    }

    /**
     * @param string $json
     * @param int $options
     * @param int $depth
     * @return mixed
     * @throws \JsonException
     */
    public static function decode(string $json, int $options = 0, int $depth = 512)
    {
        return json_decode($json, false, $depth, $options);
    }
}
