<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_cobranca_asaas');
            $table->double('value');
            $table->date('dateCreated');
            $table->date('dueDate');
            $table->string('cpf_cnpj');
            $table->foreign('cpf_cnpj')->references('cpf_cnpj')->on('users');
            $table->string('bankSlipUrl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void    
    {
        Schema::dropIfExists('boletos');
    }
};
