<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('afiliacions', function (Blueprint $table) {

            $table->string('curp')->nullable()->after('ine');
            $table->string('rfc')->nullable()->after('curp');
            $table->string('correo')->nullable()->after('telefono');

            $table->string('municipio')->nullable()->after('domicilio');
            $table->string('estado')->nullable()->after('municipio');

        });
    }

    public function down(): void
    {
        Schema::table('afiliacions', function (Blueprint $table) {

            $table->dropColumn([
                'curp',
                'rfc',
                'correo',
                'municipio',
                'estado'
            ]);

        });
    }
};