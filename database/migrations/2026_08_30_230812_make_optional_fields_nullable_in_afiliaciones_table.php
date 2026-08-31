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
        Schema::table('afiliaciones', function (Blueprint $table) {
            $table->string('ine', 30)->nullable()->change();
            $table->string('domicilio', 255)->nullable()->change();
            $table->string('municipio', 100)->nullable()->change();
            $table->string('estado', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('afiliaciones', function (Blueprint $table) {
            $table->string('ine', 30)->nullable(false)->change();
            $table->string('domicilio', 255)->nullable(false)->change();
            $table->string('municipio', 100)->nullable(false)->change();
            $table->string('estado', 100)->nullable(false)->change();
        });
    }
};