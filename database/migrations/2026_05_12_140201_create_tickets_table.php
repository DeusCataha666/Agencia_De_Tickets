<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('tickets', function (Blueprint $table) {

            $table->id();

            $table->string('titulo');
            $table->text('descripcion');
            $table->text('imagen')->nullable();
            $table->tinyInteger('estado')->default(1);
            $table->string('registrado_por');

            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_cierre')->nullable();

            $table->foreignId('cliente_id')
                ->constrained('clientes');

            $table->foreignId('usuario_asignado_id')
                ->nullable()
                ->constrained('usuarios');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
