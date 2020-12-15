<?php

namespace App\Http\Controllers\Matrix;

use App\Rules\Matrix;
use Illuminate\Http\Request;
use App\Rules\CanBeMultiplierOf;
use Illuminate\Http\JsonResponse;
use App\Services\MatrixMultiplier;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Exceptions\UnexpectedMatrixValueException;

final class MultiplyAction extends Controller
{
    /**
     * The matrix multiplier service.
     *
     * @var MatrixMultiplier
     */
    private MatrixMultiplier $matrixMultiplier;

    /**
     * MultiplyAction constructor.
     *
     * @param MatrixMultiplier $matrixMultiplier
     */
    public function __construct(MatrixMultiplier $matrixMultiplier)
    {
        $this->matrixMultiplier = $matrixMultiplier;
    }

    /**
     * Multiplies the given matrices and returns the product matrices
     * as two dimensional string arrays.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $matrix1 = $request->input('first_matrix');
        $matrix2 = $request->input('second_matrix');

        $this->validate($request, [
            'first_matrix' => ['bail', 'required', new Matrix()],
            'second_matrix' => ['bail', 'required', new Matrix(), new CanBeMultiplierOf($matrix1)],
        ]);

        try {
            $multiplication = $this->matrixMultiplier->multiply($matrix1, $matrix2);
        } catch (UnexpectedMatrixValueException $matrixValueException) {
            throw ValidationException::withMessages(['second_matrix' => $matrixValueException->getMessage()]);
        }

        return new JsonResponse([
            'product' => $multiplication,
        ], 200);
    }
}
