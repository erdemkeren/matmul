<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Rules\CanBeMultiplierOf;

/**
 * @coversNothing
 */
class CanBeMultiplierOfRuleTest extends TestCase
{
    public function testItDoesntFailWithNonArrayConstructors(): void
    {
        $matrix2 = [[1, 2], [1, 2], [1, 2]];

        $this->assertFalse((new CanBeMultiplierOf(null))->passes('matrix2', $matrix2));
    }

    public function testItAllowsValidMatrices(): void
    {
        $matrix1 = [[1, 1, 1]];
        $matrix2 = [[1, 2], [1, 2], [1, 2]];

        $this->assertTrue((new CanBeMultiplierOf($matrix1))->passes('matrix2', $matrix2));
    }

    public function testItDoesntAllowUnalignedMatrices(): void
    {
        $matrix1 = [[1, 2], [1, 2], [1, 2]];
        $matrix2 = [[1, 1, 1]];

        $this->assertFalse((new CanBeMultiplierOf($matrix1))->passes('matrix2', $matrix2));
    }
}
