<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCreateResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function find(Request $request){
        $request->validate([
            'cpfCnpj' => ['required','string']
        ]);

        $user = User::findOrFail(preg_replace('/[^0-9\s]/', '', $request->cpfCnpj));

        return new UserResource($user);
    }

    public function create(Request $request){
        $request->validate([
            'name' => ['required','string'],
            'cpfCnpj' => ['required','string']
        ]);

        $response = Http::withHeaders([
             'accept' => 'application/json',
             'content-type' => 'application/json',
             'access_token' => env('API_KEY')
        ])->post('https://sandbox.asaas.com/api/v3/customers', [
             'name' => $request->name,
             'cpfCnpj' => $request->cpfCnpj
        ]);

        $response = json_decode($response);

        $user = User::create([
            'customer' => $response->id,
            'name' =>  $response->name,
            'cpf_cnpj' => $response->cpfCnpj
        ]);

        return new UserResource($user);

    }
}
