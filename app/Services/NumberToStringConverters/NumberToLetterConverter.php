<?php

declare(strict_types=1);

namespace App\Services\NumberToStringConverters;

final class NumberToLetterConverter implements NumberToStringConverterContract
{
    private array $cache = [];

    /**
     * A zero index number to alphabet converter implementation.
     *
     * 0 => A
     * 26 => AA
     *
     * @param int $number
     *
     * @return string
     */
    public function convert(int $number): string
    {
        $letters = '';

        if (array_key_exists($number, $this->cache)) {
            return $this->cache[$number];
        }

        $isNegative = $number < 0;
        $number = abs($number);
        for (; $number >= 0; $number = (int) ($number / 26) - 1) {
            $letters = chr($number % 26 + 65).$letters;
        }

        return $this->cache[$number] = $isNegative ? ('-'.$letters) : $letters;
    }
}
