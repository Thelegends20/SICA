<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('afiliaciones', function (Blueprint $table) {
            $table->id();

            $table->string('folio_afiliado')->unique();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('ine');

            $table->string('curp')->nullable();
            $table->string('rfc')->nullable();
            $table->string('correo')->nullable();

            $table->string('domicilio');
            $table->string('municipio')->nullable();
            $table->string('estado')->nullable();

            $table->string('estatus')->default('VIGENTE');
            $table->date('vigencia');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('afiliaciones');
    }
};