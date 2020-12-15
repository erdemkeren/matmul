<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Exceptions\UnexpectedMatrixValueException;
use App\Services\NumberToStringConverters\NumberToStringConverterContract;

final class MatrixMultiplier
{
    /**
     * The number to string contract implementation.
     *
     * @var NumberToStringConverterContract
     */
    private NumberToStringConverterContract $numberToStringConverter;

    /**
     * MatrixMultiplier constructor.
     *
     * @param NumberToStringConverterContract $numberToStringConverter
     */
    public function __construct(NumberToStringConverterContract $numberToStringConverter)
    {
        $this->numberToStringConverter = $numberToStringConverter;
    }

    /**
     * Multiply the given two matrices.
     * The matrices should be validated first.
     *
     * @param array $matrix1
     * @param array $matrix2
     *
     * @return array
     */
    public function multiply(array $matrix1, array $matrix2): array
    {
        try {
            $product = [];
            $matrix1Size = count($matrix1);

            for ($i = 0; $i < $matrix1Size; ++$i) {
                $row = $matrix1[$i];
                $rowSize = count($row);
                $productRow = [];

                $matrix2ColSize = count($matrix2[0]);
                for ($j = 0; $j < $matrix2ColSize; ++$j) {
                    for ($k = 0; $k < $rowSize; ++$k) {
                        $multiplicand = $row[$k];
                        $multiplier = $matrix2[$k][$j];

                        $productRow[$j] =
                            (array_key_exists($j, $productRow) ? $productRow[$j] : 0) + $multiplicand * $multiplier;
                    }
                    $productRow[$j] = $this->numberToStringConverter->convert((int) $productRow[$j]);
                }

                $product[$i] = $productRow;
            }
        } catch (Exception $e) {
            throw UnexpectedMatrixValueException::createForInvalidMatrixData();
        }

        return $product;
    }
}
