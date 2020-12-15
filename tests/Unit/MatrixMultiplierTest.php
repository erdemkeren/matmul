<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\MatrixMultiplier;
use PHPUnit\Framework\MockObject\MockObject;
use App\Services\NumberToStringConverters\NumberToStringConverterContract;

/**
 * @covers \App\Services\MatrixMultiplier
 */
class MatrixMultiplierTest extends TestCase
{
    /**
     * The mocked converter implementation.
     *
     * @var MockObject|NumberToStringConverterContract
     */
    private NumberToStringConverterContract $converter;

    private MatrixMultiplier $multiplier;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->converter = $this->createMock(NumberToStringConverterContract::class);
        $this->multiplier = new MatrixMultiplier($this->converter);
    }

    public function testItMultipliesTwoMatrices(): void
    {
        $converterResult = '1';
        $this->converter
            ->expects($this->once())
            ->method('convert')
            ->with(1)
            ->willReturn($converterResult);
        $productString = $this->multiplier->multiply([[1]], [[1]]);
        $this->assertSame([[$converterResult]], $productString);
    }

    public function testItMultipliesTwoFloatMatricesAndConvertsResults(): void
    {
        $converterResult = '0';
        $this->converter
            ->expects($this->once())
            ->method('convert')
            ->with(0)
            ->willReturn($converterResult);
        $productString = $this->multiplier->multiply([[1]], [[0.2]]);
        $this->assertSame([[$converterResult]], $productString);
    }
}
