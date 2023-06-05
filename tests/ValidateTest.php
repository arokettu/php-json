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
}
