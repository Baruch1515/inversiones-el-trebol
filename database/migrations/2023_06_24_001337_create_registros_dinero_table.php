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
        Schema::create('registros_dinero', function (Blueprint $table) {
            $table->id();
            $table->decimal('dinero_global', 8, 4); // Cambia la precisión y escala según tus necesidades
            $table->decimal('dinero_cartera', 9, 3); // Cambia la precisión y escala según tus necesidades
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros_dinero');
    }
};
