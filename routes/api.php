<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/administrator', function (Request $request) {
    return $request->Auth::guard('administrator')->user();
});

Route::middleware('auth:sanctum')->get('/teacher', function (Request $request) {
    return $request->Auth::guard('teacher')->user();
});
