<?php

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\DecodeOptions;
use Arokettu\Json\EncodeOptions;
use Arokettu\Json\Json;
use Arokettu\Json\ValidateOptions;
use PHPUnit\Framework\TestCase;

final class OptionsAsObjectTest extends TestCase
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
        $this->expectException(\TypeError::class);

        Json::encode(['a' => 'b'], DecodeOptions::default());
    }

    public function testEncodeOptionsInvalidScalar(): void
    {
        $this->expectException(\TypeError::class);

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
        $this->expectException(\TypeError::class);

        Json::decode('{"a":"b"}', EncodeOptions::default());
    }

    public function testDecodeToArrayOptionsInvalidClass(): void
    {
        $this->expectException(\TypeError::class);

        Json::decodeToArray('{"a":"b"}', EncodeOptions::default());
    }

    public function testDecodeToObjectOptionsInvalidClass(): void
    {
        $this->expectException(\TypeError::class);

        Json::decodeToObject('{"a":"b"}', EncodeOptions::default());
    }

    public function testDecodeOptionsInvalidScalar(): void
    {
        $this->expectException(\TypeError::class);

        Json::decode('{"a":"b"}', '0');
    }

    public function testDecodeToArrayOptionsInvalidScalar(): void
    {
        $this->expectException(\TypeError::class);

        Json::decodeToArray('{"a":"b"}', '0');
    }

    public function testDecodeToObjectOptionsInvalidScalar(): void
    {
        $this->expectException(\TypeError::class);

        Json::decodeToObject('{"a":"b"}', '0');
    }

    public function testPassValidateOptions(): void
    {
        $valid = Json::validate('{"a":"b"}', ValidateOptions::default());

        self::assertEquals(true, $valid);
    }

    public function testValidateOptionsInvalidClass(): void
    {
        $this->expectException(\TypeError::class);

        Json::validate('{"a":"b"}', DecodeOptions::default());
    }

    public function testValidateOptionsInvalidScalar(): void
    {
        $this->expectException(\TypeError::class);

        Json::validate('{"a":"b"}', '0');
    }
}
