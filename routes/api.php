<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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





/* por medio del middleware blindamos la ruta para se autenticada por medio de passport 
en el collection de postman, la request  get a token tiene lo necesario para generar el token de un usuario, ese token se debe enviar en cada peticion al endpoint
*/
Route::group(['middleware' => 'auth:api'], function()
{
    Route::apiResource('users', UserController::class);
});

Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::middleware('auth:api')->post('/logout', 'App\Http\Controllers\AuthController@logout');