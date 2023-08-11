<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo_cobranca_asaas',
        'value',
        'dateCreated',
        'dueDate',
        'customer_code',
        'bankSlipUrl'
    ];
}
