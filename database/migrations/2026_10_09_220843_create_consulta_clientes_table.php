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
        Schema::create('consultas_clientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->cascadeOnDelete();

            $table->foreignId('proceso_id')
                ->nullable()
                ->constrained('procesos')
                ->nullOnDelete();

            $table->text('mensaje');
            $table->text('respuesta')->nullable();

            $table->string('estado')->default('nueva');

            $table->timestamp('respondida_at')->nullable();
            $table->timestamp('cerrada_at')->nullable();

            $table->timestamps();

            $table->index(['cliente_id', 'estado']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas_clientes');
    }
};
