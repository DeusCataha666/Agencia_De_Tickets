<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tipo_usuarios', function (Blueprint $table) {
            $table->unique('nombre_tipo', 'tipo_usuarios_nombre_tipo_unique');
        });
    }

    public function down(): void
    {
        Schema::table('tipo_usuarios', function (Blueprint $table) {
            $table->dropUnique('tipo_usuarios_nombre_tipo_unique');
        });
    }
};
