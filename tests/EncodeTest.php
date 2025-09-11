<?php

/**
 * @copyright 2020 Anton Smirnov
 * @license MIT https://spdx.org/licenses/MIT.html
 */

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\Json;
use PHPUnit\Framework\TestCase;

final class EncodeTest extends TestCase
{
    public function testException(): void
    {
        $this->expectException(\JsonException::class);

        $data = \fopen(__FILE__, 'r');
        Json::encode($data);
    }
}
