<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CanBeMultiplierOf implements Rule
{
    /**
     * The first matrix.
     *
     * @var mixed
     */
    private $firstMatrix;

    /**
     * Create a new rule instance.
     *
     * @param mixed $firstMatrix
     *
     * @return void
     */
    public function __construct($firstMatrix)
    {
        $this->firstMatrix = $firstMatrix;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return is_array($this->firstMatrix)
            && array_key_exists(0, $this->firstMatrix)
            && count($this->firstMatrix[0]) === \count($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.matrix.not_aligned');
    }
}
