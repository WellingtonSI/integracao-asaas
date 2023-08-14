<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartaoResource;
use App\Models\Cartao;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagamentoCartaoController extends Controller
{
    public function criarCobrancaAVista(Request $request){
        $request->validate([
            'customer' => ['required','string'],
            'value' => ['required','numeric'],
            'dueDate' => ['required','date'],
            'holderName'=> ['required','string'],
            'number' =>  ['required','string'],
            'expiryMonth' =>  ['required','string'],
            'expiryYear' =>  ['required','string'],
            'ccv' =>  ['required','string'],
            'name' =>  ['required','string'],
            'email' =>  ['required','email'],
            'cpfCnpj' => ['required','string'],
            'postalCode' => ['required','string'],
            'addressNumber' => ['required','string'],
            'phone' => ['required','string'],
            'remoteIp' => ['required','string'],
        ]);


        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'access_token' => env('API_KEY')
       ])->post('https://sandbox.asaas.com/api/v3/payments/', [
            'customer' => $request->customer,
            'billingType' => "CREDIT_CARD",
            'value' => $request->value,
            'dueDate' => $request->dueDate,
            'creditCard' => [
                'holderName' => $request->name,
                'number' => $request->number,
                'expiryMonth' => $request->expiryMonth,
                'expiryYear' => $request->expiryYear,
                'ccv' => $request->ccv,
            ],
            'creditCardHolderInfo' => [
                'name' => $request->name,
                'email' =>  $request->email,
                'cpfCnpj' => $request->cpfCnpj,
                'postalCode' => $request->postalCode,
                'addressNumber' => $request->addressNumber,
                'phone' => $request->phone
            ],
            'remoteIp' => $request->remoteIp
       ]);

       $response = json_decode($response);
    dd($response);
       $cartao = Cartao::create([
        'codigo_cobranca_asaas' =>  $response->id,
        'value' => $response->value,
        'dateCreated' => $response->dateCreated,
        'dueDate' => $response->dueDate,
        'cpf_cnpj' => preg_replace('/[^0-9\s]/', '', $request->cpfCnpj),
        'transactionReceiptUrl' => $response->transactionReceiptUrl,
        'creditCardToken' => $response->creditCard->creditCardToken
       ]);

       return new CartaoResource($cartao);

    }

    public function criarCobrancaParcelado(Request $request){
        $request->validate([
            'customer' => ['required','string'],
            'value' => ['required','numeric'],
            'installmentCount' => ['required','numeric'],
            'installmentValue' => ['required','numeric'],
            'dueDate' => ['required','date'],
            'holderName'=> ['required','string'],
            'number' =>  ['required','string'],
            'expiryMonth' =>  ['required','string'],
            'expiryYear' =>  ['required','string'],
            'ccv' =>  ['required','string'],
            'name' =>  ['required','string'],
            'email' =>  ['required','email'],
            'cpfCnpj' => ['required','string'],
            'postalCode' => ['required','string'],
            'addressNumber' => ['required','string'],
            'phone' => ['required','string'],
            'remoteIp' => ['required','string'],
        ]);


        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'access_token' => env('API_KEY')
        ])->post('https://sandbox.asaas.com/api/v3/payments/', [
            'customer' => $request->customer,
            'billingType' => "CREDIT_CARD",
            'value' => $request->value,
            'dueDate' => $request->dueDate,
            'installmentCount' => $request->installmentCount,
            'installmentValue' => $request->installmentValue,
            'creditCard' => [
                'holderName' => $request->name,
                'number' => $request->number,
                'expiryMonth' => $request->expiryMonth,
                'expiryYear' => $request->expiryYear,
                'cvv' => $request->css,
            ],
            'creditCardHolderInfo' => [
                'name' => $request->name,
                'email' =>  $request->email,
                'cpfCnpj' => $request->cpfCnpj,
                'postalCode' => $request->postalCode,
                'addressNumber' => $request->addressNumber,
                'phone' => $request->phone
            ],
            'remoteIp' => $request->remoteIp
        ])->json();

       if($response->errors){
            return response()->json($response->errors,400);
       }

       try{
            Cartao::create([
                'codigo_cobranca_asaas' =>  $response->id,
                'value' => $response->value,
                'dateCreated' => $response->dateCreated,
                'dueDate' => $response->dueDate,
                'customer_code' => $response->customer,
                'transactionReceiptUrl' => $response->transactionReceiptUrl,
                'creditCardToken' => $response->creditCard->creditCardToken
           ]);
       }catch(Exception $e){
            return response()->json('Erro! tente novamente mais tarde',500);
       }
        

       return response()->json('Sucesso',200);
    }
}
