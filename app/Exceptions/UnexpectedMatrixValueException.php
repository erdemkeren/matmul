<?php

namespace App\Exceptions;

use UnexpectedValueException;

final class UnexpectedMatrixValueException extends UnexpectedValueException
{
    public static function createForInvalidMatrixData(): UnexpectedValueException
    {
        return new static('Invalid matrix data encountered. Please check the matrix definitions.');
    }
}
