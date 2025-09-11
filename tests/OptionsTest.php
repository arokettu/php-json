<?php

declare(strict_types=1);

namespace Arokettu\Json\Tests;

use Arokettu\Json\EncodeOptions;
use PHPUnit\Framework\TestCase;

final class OptionsTest extends TestCase
{
    public function testConstantsString(): void
    {
        self::assertEquals(
            'JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR',
            EncodeOptions::pretty()->toString(),
        );
    }

    public function testNoConstantsString(): void
    {
        self::assertEquals('0', EncodeOptions::build(0)->toString());
    }
}
