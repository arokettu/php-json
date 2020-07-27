<?php

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\Json;
use PHPUnit\Framework\TestCase;

class EncodeTest extends TestCase
{
    public function testException()
    {
        $this->expectException(\JsonException::class);

        $data = fopen(__FILE__, 'r');
        Json::encode($data);
    }
}
