<?php
declare(strict_types=1);

namespace Tests\utils;

use DestiniaPruebaTecnica\util\InputTextNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DestiniaPruebaTecnica\util\InputTextNormalizer
 */
class InputTextNormalizerTest extends TestCase
{
    /**
     * @return void
     */
    public function testNormalize(): void
    {
        $this->assertEquals('sample-text-1', InputTextNormalizer::normalize('Sample text 1!!'));
        $this->assertEquals('sample-text-2', InputTextNormalizer::normalize(' SAMPLE TEXT\'  2'));
        $this->assertEquals('sample-text-3', InputTextNormalizer::normalize('Sámple téxt       3!!'));
    }
}