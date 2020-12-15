<?php

namespace Tests\Unit;

use App\Rules\Matrix;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Rules\Matrix
 */
class MatrixRuleTest extends TestCase
{
    public function testItAllowsValidMatrices(): void
    {
        $matrix1 = [[1, 2], [1, 2], [1, 2]];

        $this->assertTrue((new Matrix())->passes('matrix1', $matrix1));
    }

    public function testItAllowsInvalidMatrices(): void
    {
        $invalid = [[1, 'A'], [1, 2], [1, 2]];

        $this->assertFalse((new Matrix())->passes('invalid', $invalid));
    }

    public function testItDoesntAllowCorruptedMatrices(): void
    {
        $corrupted = [[1, 2], [1, 2], [1, 2, 3]];

        $this->assertFalse((new Matrix())->passes('corrupted', $corrupted));
    }

    public function testItValidatesOneDimensionalArrays(): void
    {
        $corrupted = [];

        $this->assertFalse((new Matrix())->passes('corrupted', $corrupted));
    }
}
