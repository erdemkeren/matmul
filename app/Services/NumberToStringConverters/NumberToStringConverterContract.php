<?php

namespace App\Services\NumberToStringConverters;

interface NumberToStringConverterContract
{
    /**
     * Convert the given int value to a string.
     *
     * @param int $number
     *
     * @return string
     */
    public function convert(int $number): string;
}
