<?php

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\Json;
use PHPUnit\Framework\TestCase;

class DecodeTest extends TestCase
{
    public function testScalar()
    {
        $this->assertEquals('test', Json::decode('"test"'));
        $this->assertEquals(123, Json::decode('123'));
        $this->assertEquals(null, Json::decode('null'));
        $this->assertEquals(false, Json::decode('false'));
    }

    public function testArray()
    {
        $this->assertEquals([1, 2, 3, "4"], Json::decode('[1,2,3,"4"]'));
    }

    public function testObject()
    {
        $obj = Json::decode('{"aaa": 123, "bbb": "abc"}');

        $this->assertInstanceOf(\ArrayObject::class, $obj);
        $this->assertCount(2, $obj);
        $this->assertEquals(['aaa' => 123, 'bbb' => 'abc'], $obj->getArrayCopy());
    }

    public function testException()
    {
        $this->expectException(\JsonException::class);
        Json::decode('{');
    }

    public function testAssocIgnored()
    {
        $obj = Json::decode('{"aaa": 123, "bbb": "abc"}', JSON_OBJECT_AS_ARRAY);

        $this->assertInstanceOf(\ArrayObject::class, $obj);
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

        $decoded = Json::decode($json);

        $this->assertIsArray($decoded);
        $this->assertInstanceOf(\ArrayObject::class, $decoded[0]);
        $this->assertIsArray($decoded[0]['abc']);
        $this->assertInstanceOf(\ArrayObject::class, $decoded[0]['abc'][1]);
        $this->assertEquals(123, $decoded[0]['abc'][1]['xyz']);
    }
}
