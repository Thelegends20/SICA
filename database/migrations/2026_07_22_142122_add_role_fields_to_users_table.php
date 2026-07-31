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
        Schema::table('users', function (Blueprint $table) {

            $table->enum('rol', [
                'ADMIN_PRINCIPAL',
                'ADMIN_AUXILIAR',
                'COORDINADOR'
            ])->default('COORDINADOR');

            $table->boolean('activo')
                  ->default(true);

            $table->string('telefono')
                  ->nullable();

            $table->string('municipio')
                  ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'rol',
                'activo',
                'telefono',
                'municipio'
            ]);

        });
    }
};