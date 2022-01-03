<?php

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\Json;
use PHPUnit\Framework\TestCase;

class DecodeToObjectTest extends TestCase
{
    public function testParams(): void
    {
        // get object when not passing param
        $this->assertInstanceOf(\ArrayObject::class, Json::decode('{}'));
        // get object with decodeToObject even with param
        $this->assertInstanceOf(\ArrayObject::class, Json::decodeToObject('{}', JSON_OBJECT_AS_ARRAY));
    }

    public function testScalar(): void
    {
        $this->assertEquals('test', Json::decodeToObject('"test"'));
        $this->assertEquals(123, Json::decodeToObject('123'));
        $this->assertEquals(null, Json::decodeToObject('null'));
        $this->assertEquals(false, Json::decodeToObject('false'));
    }

    public function testArray(): void
    {
        $this->assertEquals([1, 2, 3, "4"], Json::decodeToObject('[1,2,3,"4"]'));
    }

    public function testObject(): void
    {
        $obj = Json::decodeToObject('{"aaa": 123, "bbb": "abc"}');

        $this->assertInstanceOf(\ArrayObject::class, $obj);
        $this->assertCount(2, $obj);
        $this->assertEquals(['aaa' => 123, 'bbb' => 'abc'], $obj->getArrayCopy());
    }

    public function testException(): void
    {
        $this->expectException(\JsonException::class);

        Json::decodeToObject('{');
    }

    public function testExceptionIsEnforced(): void
    {
        $this->expectException(\JsonException::class);

        Json::decodeToObject('{', 0);
    }

    public function testAssocIgnored(): void
    {
        $obj = Json::decodeToObject('{"aaa": 123, "bbb": "abc"}', JSON_OBJECT_AS_ARRAY);

        $this->assertInstanceOf(\ArrayObject::class, $obj);
    }

    public function testRecursion(): void
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

        $decoded = Json::decodeToObject($json);

        $this->assertIsArray($decoded);
        $this->assertInstanceOf(\ArrayObject::class, $decoded[0]);
        $this->assertIsArray($decoded[0]['abc']);
        $this->assertInstanceOf(\ArrayObject::class, $decoded[0]['abc'][1]);
        $this->assertEquals(123, $decoded[0]['abc'][1]['xyz']);
    }
}
