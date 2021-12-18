<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnagramController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'a' => 'required|max:50',
            'b' => 'required|max:50'
        ]);

        try {
            $array_char = str_split(mb_strtolower(trim($request->a), 'UTF-8'));
            sort($array_char);
            $string_a = implode('', $array_char);
    
            $array_char = str_split(mb_strtolower(trim($request->b), 'UTF-8'));
            sort($array_char);
            $string_b = implode('', $array_char);
        } catch (\Throwable $th) {
            return response()->json(['error' => trans('messages.default_error')]);
        }

        $result = 'messages.' . (($string_a == $string_b) ? 'anagram_result' : 'anagram_not_result');        
        $message = trans($result, array('a' => $request->a, 'b' => $request->b));

        return response()->json(['data' => $message], 200);
    }
}
