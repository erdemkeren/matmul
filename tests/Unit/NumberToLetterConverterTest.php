<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\NumberToStringConverters\NumberToLetterConverter;
use App\Services\NumberToStringConverters\NumberToStringConverterContract;

/**
 * @coversNothing
 */
class NumberToLetterConverterTest extends TestCase
{
    private NumberToStringConverterContract $converter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->converter = new NumberToLetterConverter();
    }

    public function testItIsInstanceOfNumberToStringConverterContract(): void
    {
        $this->assertInstanceOf(NumberToStringConverterContract::class, $this->converter);
    }

    /**
     * A basic feature test example.
     */
    public function testItCalculatesTheLettersForPositiveIntegers(): void
    {
        $expected = 'A';

        for ($x = 0; $x < 1000; ++$x) {
            $this->assertSame($expected++, $this->converter->convert($x));
        }
    }

    public function testItAddsNegativeSignForNegativeNumbers(): void
    {
        $this->assertSame('-Y', $this->converter->convert(-24));
    }
}
