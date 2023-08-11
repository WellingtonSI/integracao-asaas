<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartaoResource;
use App\Models\Cartao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagamentoCartãoController extends Controller
{
    public function criarCobrancaAVista(Request $request){
        $request->validate([
            'customer' => ['required','string'],
            'value' => ['required','float'],
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
       ]);

       $response = json_decode($response);

       $cartao = Cartao::create([
        'codigo_cobranca_asaas' =>  $response->id,
        'value' => $response->value,
        'dateCreated' => $response->dateCreated,
        'dueDate' => $response->dueDate,
        'customer_code' => $response->customer,
        'transactionReceiptUrl' => $response->transactionReceiptUrl,
        'creditCardToken' => $response->creditCard->creditCardToken
       ]);

       return new CartaoResource($cartao);

    }

    public function criarCobrancaParcelado(Request $request){
        $request->validate([
            'customer' => ['required','string'],
            'value' => ['required','float'],
            'installmentCount' => ['required','integer'],
            'installmentValue' => ['required','float'],
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
       ]);

       $response = json_decode($response);

       if($response->errors){
            return response()->json($response->errors,400);
       }

       $cartao = Cartao::create([
        'codigo_cobranca_asaas' =>  $response->id,
        'value' => $response->value,
        'dateCreated' => $response->dateCreated,
        'dueDate' => $response->dueDate,
        'customer_code' => $response->customer,
        'transactionReceiptUrl' => $response->transactionReceiptUrl,
        'creditCardToken' => $response->creditCard->creditCardToken
       ]);

       return new CartaoResource($cartao);
    }
}
