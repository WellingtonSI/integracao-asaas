<?php

use App\Http\Controllers\PagamentoBoletoController;
use App\Http\Controllers\PagamentoCartãoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/boleto', [PagamentoBoletoController::class, 'criarCobrancaBoleto']);

Route::post('/cartao',[PagamentoCartaoController::class, ]);  

Route::group(['prefix' => 'pix'], function($router) {
    
});  

Route::group(['prefix' => 'user'], function($router) {
    Route::get('/find', [UserController::class, 'find']);
    Route::post('/create', [UserController::class, 'create']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
