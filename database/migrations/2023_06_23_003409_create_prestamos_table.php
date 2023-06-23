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
            $table->decimal('cuotas');
            $table->decimal('monto', 8, 3); // 8 dígitos en total, con 3 decimales            $table->unsignedInteger('cuotas');
            $table->decimal('intereses', 5, 2); // 5 dígitos en total, con 2 decimales
            $table->string('cobro');
            $table->decimal('monto_cuota', 8, 3);
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
