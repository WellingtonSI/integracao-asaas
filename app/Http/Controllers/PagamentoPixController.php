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
            'cpfCnpj' => ['required','string'],
            'value' => ['required','numeric'],
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
       ]);
       
       $response = json_decode($response);

       try{
            self::verificarChavePix();

            $pix = Pix::create([
                'codigo_cobranca_asaas' => $response->id,
                'value' =>  $response->value,
                'dateCreated' => $response->dateCreated,
                'dueDate' =>  $response->dueDate,
                'cpf_cnpj' => preg_replace('/[^0-9\s]/', '', $request->cpfCnpj)
           ]);
    
        }
        catch(Exception $e){
            Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'access_token' => env('API_KEY')
            ])->delete("https://sandbox.asaas.com/api/v3/payments/$response->id");

            return response()->json($e. ' Erro! tente novamente mais tarde',500);
        }
           
       $response = (object) Http::withHeaders([
        'accept' => 'application/json',
        'content-type' => 'application/json',
        'access_token' => env('API_KEY')
        ])->get("https://sandbox.asaas.com/api/v3/payments/$pix->codigo_cobranca_asaas/pixQrCode")->json();

        return new PixResource($response);
    }

    private function verificarChavePix(){
        $response = (object) Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'access_token' => env('API_KEY')
        ])->get("https://sandbox.asaas.com/api/v3/pix/addressKeys?status=ACTIVE");

        if(empty($response->data)){
            Http::withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'access_token' => env('API_KEY')
            ])->post('https://sandbox.asaas.com/api/v3/pix/addressKeys', [
                "type" => "EVP"
           ]);
        }
    }
}
