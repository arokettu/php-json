<?php

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\DecodeOptions;
use Arokettu\Json\EncodeOptions;
use Arokettu\Json\Json;
use PHPUnit\Framework\TestCase;

class OptionsAsObjectTest extends TestCase
{
    public function testPassEncodeOptions(): void
    {
        $json = Json::encode(['a' => 'b'], EncodeOptions::pretty());

        self::assertEquals(<<<JSON
            {
                "a": "b"
            }
            JSON, $json);
    }

    public function testEncodeOptionsInvalidClass(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Json::encode(['a' => 'b'], DecodeOptions::default());
    }

    public function testEncodeOptionsInvalidScalar(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Json::encode(['a' => 'b'], '0');
    }

    public function testPassDecodeOptions(): void
    {
        $data = Json::decode('{"a":"b"}', DecodeOptions::default());
        self::assertEquals(new \ArrayObject(['a' => 'b']), $data);

        $data = Json::decode('{"a":"b"}', DecodeOptions::asArray());
        self::assertEquals(['a' => 'b'], $data);

        // check that asArray do not affect specific methods

        $data = Json::decodeToObject('{"a":"b"}', DecodeOptions::asArray());
        self::assertEquals(new \ArrayObject(['a' => 'b']), $data);

        $data = Json::decodeToArray('{"a":"b"}', DecodeOptions::default());
        self::assertEquals(['a' => 'b'], $data);
    }

    public function testDecodeOptionsInvalidClass(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Json::decode('{"a":"b"}', EncodeOptions::default());
    }

    public function testDecodeToArrayOptionsInvalidClass(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Json::decodeToArray('{"a":"b"}', EncodeOptions::default());
    }

    public function testDecodeToObjectOptionsInvalidClass(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Json::decodeToObject('{"a":"b"}', EncodeOptions::default());
    }

    public function testDecodeOptionsInvalidScalar(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Json::decode('{"a":"b"}', '0');
    }

    public function testDecodeToArrayOptionsInvalidScalar(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Json::decodeToArray('{"a":"b"}', '0');
    }

    public function testDecodeToObjectOptionsInvalidScalar(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Json::decodeToObject('{"a":"b"}', '0');
    }
}
