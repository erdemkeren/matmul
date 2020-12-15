<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Matrix implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $matrix
     *
     * @return bool
     */
    public function passes($attribute, $matrix)
    {
        if (!is_array($matrix) || empty($matrix)) {
            return false;
        }

        $prevRowSize = 0;
        foreach ($matrix as $row) {
            if (!is_array($row)) {
                return false;
            }

            $rowSize = count($row);
            if (!$rowSize || ($prevRowSize && $prevRowSize !== $rowSize)) {
                return false;
            }

            foreach ($row as $cell) {
                if (!is_numeric($cell)) {
                    return false;
                }
            }

            $prevRowSize = $rowSize;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.matrix.invalid');
    }
}
