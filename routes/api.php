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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('receiveconfirmmailck',[App\Http\Controllers\UserFrontendController::class,'receiveconfirmmailck'])->name('api.receiveconfirmmailck');

Route::get('api_call_bot',[App\Http\Controllers\ApiController::class,'api_call_bot']);
Route::post('api_call_bot_fall_back',[App\Http\Controllers\ApiController::class,'api_call_bot_fall_back']);