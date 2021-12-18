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

        
    }
}
