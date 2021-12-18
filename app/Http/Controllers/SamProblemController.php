<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SamProblemController extends Controller
{
    public function inclusiveInterval(Request $request)
    {
        $request->validate([
            "dm" => "required|array",
            "dn" => "required|array",
            "m" => "required|numeric",
            "n" => "required|numeric",
            "s" => "required|numeric",
            "t" => "required|numeric",
            "a" => "required|numeric",
            "b" => "required|numeric",
        ]);

        try {
            $inclusive_interval = array($request->s, $request->t);

            $result_distance_dm = $this->calculateDistante($request->dm, $request->a);
            $result_distance_dn = $this->calculateDistante($request->dn, $request->b);

            $apples = $this->calculateCountInInterval($inclusive_interval, $result_distance_dm );
            $oranges = $this->calculateCountInInterval($inclusive_interval, $result_distance_dn);
            
        } catch (\Throwable $th) {
            return response()->json(['error' => trans('messages.default_error')]);
        }

        $message = trans('messages.inclusive_interval', array('m' => $apples, 'n' => $oranges));

        return response()->json(['data' => $message], 200);
    }

    private function calculateDistante(array $distance_fruit, int $tree) : array
    {
        $distances = array();

        foreach ($distance_fruit as $key => $distance) {
            $distances[] = $distance + $tree;
        }

        return $distances;
    }

    private function calculateCountInInterval(array $inclusive_interval, array $distances_fruit) : int
    {
        $count = 0;

        foreach ($inclusive_interval as $key => $interval) {
            $find = filter_var($interval, FILTER_VALIDATE_INT, 
                array(
                    'options' => array(
                        'min_range' => min($distances_fruit), 
                        'max_range' => max($distances_fruit)
                    )
                )
            );

            if ($find) {
                $count++;
            }
        }

        return $count;
    }
}
