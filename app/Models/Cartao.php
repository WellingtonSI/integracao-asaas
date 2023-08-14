<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    use HasFactory;

    protected $table = 'cartao_credito';

    protected $fillable = [
        'codigo_cobranca_asaas',
        'value',
        'dateCreated',
        'dueDate',
        'cpf_cnpj',
        'transactionReceiptUrl',
        'creditCardToken'
    ];

}
