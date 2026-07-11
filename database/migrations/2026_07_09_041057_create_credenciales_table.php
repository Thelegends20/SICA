<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credenciales', function (Blueprint $table) {

            $table->id();

            $table->foreignId('afiliado_id')
                  ->constrained('afiliacions')
                  ->cascadeOnDelete();

            $table->string('folio_credencial')->unique();

            $table->string('token_qr')->unique();

            $table->string('estatus')
                  ->default('VIGENTE');

            $table->date('vigencia');

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('credenciales');
    }
};