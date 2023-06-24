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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedInteger('cuotas');
            $table->decimal('monto', 8, 3);
            $table->unsignedInteger('intereses');
            $table->string('cobro');
            $table->string('nota');
            $table->decimal('monto_cuota', 8, 3);
            $table->decimal('ganancia', 8, 3)->nullable();
            $table->decimal('dinero_total', 8, 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
