<?php

namespace App\Http\Controllers;

use App\Http\Resources\PixResource;
use App\Models\Pix;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagamentoPixController extends Controller
{
    public function criarCobrancaPix(Request $request){
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
            'billingType' => "PIX",
            'value' => $request->value,
            'dueDate' => $request->dueDate
       ])->json();

       try{
            $pix = Pix::create([
                'codigo_cobranca_asaas' => $response->id,
                'value' =>  $response->value,
                'dateCreated' => $response->dateCreated,
                'dueDate' =>  $response->dueDate,
                'customer_code' => $request->customer
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
           
       $response = Http::withHeaders([
        'accept' => 'application/json',
        'content-type' => 'application/json',
        'access_token' => env('API_KEY')
        ])->get("https://sandbox.asaas.com/api/v3/payments/$pix->codigo_cobranca_asaas/pixQrCode")->json();


        return new PixResource($response);
    }
}
