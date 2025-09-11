<?php

/**
 * @copyright 2020 Anton Smirnov
 * @license MIT https://spdx.org/licenses/MIT.html
 */

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\Json;
use PHPUnit\Framework\TestCase;

final class DecodePostprocessorTest extends TestCase
{
    public function testScalar(): void
    {
        self::assertEquals(123, Json::stdClassToArrayObject(123));
        self::assertEquals('123', Json::stdClassToArrayObject('123'));

        self::assertEquals(123, Json::stdClassToArray(123));
        self::assertEquals('123', Json::stdClassToArray('123'));
    }

    public function testObject(): void
    {
        $value = new \stdClass();

        $value->a = 123;
        $value->b = 'abc';
        $value->c = new \stdClass();
        $value->c->test = 'test';

        self::assertEquals([
            'a' => 123,
            'b' => 'abc',
            'c' => [
                'test' => 'test',
            ],
        ], Json::stdClassToArray($value));

        self::assertEquals(new \ArrayObject([
            'a' => 123,
            'b' => 'abc',
            'c' => new \ArrayObject([
                'test' => 'test',
            ]),
        ]), Json::stdClassToArrayObject($value));
    }

    public function testArray(): void
    {
        $value1 = new \stdClass();
        $value1->a = 123;
        $value2 = new \stdClass();
        $value2->b = 'abc';

        $value = [$value1, $value2];

        self::assertEquals([['a' => 123], ['b' => 'abc']], Json::stdClassToArray($value));
        self::assertEquals([
            new \ArrayObject(['a' => 123]),
            new \ArrayObject(['b' => 'abc']),
        ], Json::stdClassToArrayObject($value));
    }
}
