<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoletoResource;
use App\Models\Boleto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagamentoBoletoController extends Controller
{
    public function criarCobrancaBoleto(Request $request){
        $request->validate([
            'customer' => ['required','string'],
            'value' => ['required','float'],
            'dueDate' => ['required','date']
        ]);
        
       $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'access_token' => env('API_KEY')
       ])->post('https://sandbox.asaas.com/api/v3/payments', [
            'customer' => $request->customer,
            'billingType' => "BOLETO",
            'value' => $request->value,
            'dueDate' => $request->dueDate
       ])->json();

       try{
            $boleto = Boleto::create([
                'codigo_cobranca_asaas' => $response->id,
                'value' =>  $response->value,
                'dateCreated' => $response->dateCreated,
                'dueDate' =>  $response->dueDate,
                'customer_code' => $request->customer,
                'bankSlipUrl' => $response->bankSlipUrl
            ]);
        }
        catch(Exception $e){
            Http::withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'access_token' => env('API_KEY')
            ])->delete("https://sandbox.asaas.com/api/v3/payments/$response->id");
            
            return response()->json('Erro! tente novamente mais tarde',500);
        }

        return new BoletoResource($boleto);
        
    }

    
}
