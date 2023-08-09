<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagamentoBoletoController extends Controller
{
    public function criarCobrancaBoleto(Request $request){
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'access_token' => env('API_KEY')
        ])->post('https://sandbox.asaas.com/api/v3/customers', [
            'name' => $request->name,
            'cpfCnpj' => $request->cpfCnpj
        ]);

        return $response;
    }
}
