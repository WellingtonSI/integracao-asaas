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
        Schema::create('pix', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_cobranca_asaas');
            $table->double('value');
            $table->date('dateCreated');
            $table->date('dueDate');
            $table->string('customer_code');
            $table->foreign('customer_code')->references('customer')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pix');
    }
};
