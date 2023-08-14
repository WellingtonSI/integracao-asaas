<?php

use App\Http\Controllers\PagamentoBoletoController;
use App\Http\Controllers\PagamentoCartaoController;
use App\Http\Controllers\PagamentoPixController;
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

Route::group(['prefix' => 'cartao'], function($router) {
    Route::post('/',[PagamentoCartaoController::class, 'criarCobrancaAVista']);
    //Route::post('/parcelado',[PagamentoCartaoController::class, 'criarCobrancaParcelado']);
}); 

Route::post('/pix',[PagamentoPixController::class, 'criarCobrancaPix']);  

Route::group(['prefix' => 'user'], function($router) {
    Route::get('/find', [UserController::class, 'find']);
    Route::post('/create', [UserController::class, 'create']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
