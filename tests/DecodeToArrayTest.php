<?php

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\Json;
use PHPUnit\Framework\TestCase;

class DecodeToArrayTest extends TestCase
{
    public function testParams()
    {
        // get array when passing param
        $this->assertIsArray(Json::decode('{}', JSON_OBJECT_AS_ARRAY));
        // get array when using decodeToArray
        $this->assertIsArray(Json::decodeToArray('{}'));
        // do not get array with decodeToObject even with param
        $this->assertIsNotArray(Json::decodeToObject('{}', JSON_OBJECT_AS_ARRAY));
    }

    public function testScalar()
    {
        $this->assertEquals('test', Json::decodeToArray('"test"'));
        $this->assertEquals(123, Json::decodeToArray('123'));
        $this->assertEquals(null, Json::decodeToArray('null'));
        $this->assertEquals(false, Json::decodeToArray('false'));
    }

    public function testArray()
    {
        $this->assertEquals([1, 2, 3, "4"], Json::decodeToArray('[1,2,3,"4"]'));
    }

    public function testObject()
    {
        $obj = Json::decodeToArray('{"aaa": 123, "bbb": "abc"}');

        $this->assertIsArray($obj);
        $this->assertCount(2, $obj);
        $this->assertEquals(['aaa' => 123, 'bbb' => 'abc'], $obj);
    }

    public function testException()
    {
        $this->expectException(\JsonException::class);

        Json::decodeToArray('{');
    }

    public function testExceptionIsEnforced()
    {
        $this->expectException(\JsonException::class);

        Json::decodeToArray('{', 0);
    }

    public function testAssocIgnored()
    {
        $obj = Json::decodeToArray('{"aaa": 123, "bbb": "abc"}', JSON_OBJECT_AS_ARRAY);

        $this->assertIsArray($obj);
    }

    public function testRecursion()
    {
        $json = <<<JSON
            [
                {
                    "abc": [
                        null,
                        {
                            "def": false,
                            "xyz": 123
                        }
                    ]
                }
            ]
            JSON;

        $decoded = Json::decodeToArray($json);

        $this->assertIsArray($decoded);
        $this->assertIsArray($decoded[0]);
        $this->assertIsArray($decoded[0]['abc']);
        $this->assertIsArray($decoded[0]['abc'][1]);
        $this->assertEquals(123, $decoded[0]['abc'][1]['xyz']);
    }
}
