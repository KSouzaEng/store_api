<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClienteController;

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

Route::post('login', [AuthController::class,'login']);
Route::post('logout',  [AuthController::class,'logout']);
Route::post('refresh',  [AuthController::class,'refresh']);
Route::get('me', [AuthController::class,'me']);


    Route::post('register', [UserController::class,'register']);




    Route::middleware(['auth'])->group(function () {
        Route::put('/user/update/{id}', [UserController::class,'update']);
        Route::delete('delete/user/{id}',[UserController::class,'destroy']);

        //Rotas do Cliente
        Route::post('register/cliente', [ClienteController::class,'registerCliente']);
        Route::get('get/cliente/{search}',[ClienteController::class,'search']);

        Route::put('/update/cliente/{id}',[ClienteController::class,'updateCliente']);
        Route::delete('delete/cliente/{id}',[ClienteController::class,'destroy']);
    });

