<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pix extends Model
{
    use HasFactory;

    protected $table = 'pix';

    protected $fillable = [
        'codigo_cobranca_asaas',
        'value',
        'dateCreated',
        'dueDate',
        'cpf_cnpj',
    ];
}
