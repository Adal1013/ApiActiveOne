<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SquareMatrixController extends Controller
{
    public function absoluteDifference(Request $request)
    {
        $lengh = count($request->matrix);

        $request->validate([
            "matrix" => "required|array",
            "matrix.*"  => "required|array|min:$lengh|max:$lengh",
        ]);

        try {
            $leftToRight = $this->sumDiagonal($request->matrix, 0);
            $rightToleft = $this->sumDiagonal($request->matrix, 1);

            $result = abs($leftToRight - $rightToleft);
        } catch (\Throwable $th) {
            return response()->json(['error' => trans('messages.default_error')]);
        }

        $message = trans('messages.absolute_difference_result', array('result' => $result));

        return response()->json(['data' => $message], 200);
    }

    private function sumDiagonal(array $matrix, int $optionDiagonal) : int
    {
        $total = 0;

        for ($i=0; $i < count($matrix); $i++) { 
            $total += $matrix[$i][($optionDiagonal == 0) ? $i : count($matrix) - $i - 1];
        }

        return $total;
    }
}
