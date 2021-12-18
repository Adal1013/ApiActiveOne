<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$base_route = 'App\Http\Controllers\\';

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/anagrams', $base_route.'AnagramController@check');
