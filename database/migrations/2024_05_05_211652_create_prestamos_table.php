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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('ruta_id')->nullable();
            $table->foreign('ruta_id')->references('id')->on('rutas')->nullable();            
            $table->unsignedInteger('cuotas');
            $table->bigInteger('monto');
            $table->unsignedInteger('intereses');
            $table->string('cobro');
            $table->string('nota')->nullable();
            $table->bigInteger('monto_cuota');
            $table->bigInteger('ganancia')->nullable();
            $table->bigInteger('dinero_total')->nullable();
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
