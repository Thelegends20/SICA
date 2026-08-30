<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('afiliado_id')
                ->constrained('afiliaciones')
                ->cascadeOnDelete();

            $table->string('folio_vehiculo')->unique();
            $table->string('token_qr')->unique();

            $table->string('marca');
            $table->string('submarca')->nullable();
            $table->string('modelo');
            $table->year('anio');
            $table->string('color');

            $table->string('vin')->unique();
            $table->string('motor')->nullable();
            $table->string('placas')->nullable();
            $table->string('serie_motor')->nullable();

            $table->string('estatus')->default('VIGENTE');
            $table->date('vigencia');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};