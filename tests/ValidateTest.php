<?php

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\Json;
use PHPUnit\Framework\TestCase;

class ValidateTest extends TestCase
{
    public function testValid(): void
    {
        self::assertTrue(Json::validate('{"aaa": 123, "bbb": "abc"}'));
    }

    public function testInvalid(): void
    {
        self::assertFalse(Json::validate('{"aaa": 123,'));
    }

    public function testInvalidUnicode(): void
    {
        self::assertFalse(Json::validate("{\"aaa\": 123, \"bbb\": \"\x80\"}"));
    }

    public function testInvalidUnicodeIgnore(): void
    {
        self::assertTrue(Json::validate("{\"aaa\": 123, \"bbb\": \"\x80\"}", \JSON_INVALID_UTF8_IGNORE));
    }
}
