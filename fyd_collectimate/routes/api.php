<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\collectimate_controller;
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

Route::post('/v1/auth', [LoginController::class, 'api_login']);

Route::middleware('auth:sanctum')->controller(collectimate_controller::class)->group(function () {
    Route::get('/v1/license', 'get_license')->name('licenses.get-license');
    Route::get('/v1/script-retrieve', 'get_script')->name('licenses.script-retrieve');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
