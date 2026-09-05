<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documento_vehiculos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehiculo_id')
                ->constrained('vehiculos')
                ->cascadeOnDelete();

            $table->string('tipo_documento');

            $table->string('nombre_original')->nullable();

            $table->string('archivo');

            $table->string('mime_type')->nullable();

            $table->unsignedBigInteger('tamano')->nullable();

            $table->enum('estatus', [
                'PENDIENTE',
                'VALIDADO',
                'OBSERVADO',
            ])->default('PENDIENTE');

            $table->text('observaciones')->nullable();

            $table->unsignedBigInteger('revisado_por')->nullable();

            $table->timestamp('revisado_at')->nullable();

            $table->timestamps();

            $table->index('vehiculo_id');
            $table->index('tipo_documento');
            $table->index('estatus');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documento_vehiculos');
    }
};