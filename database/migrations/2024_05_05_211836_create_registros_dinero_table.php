
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
            $table->decimal('dinero_global', 8, 2); // Cambia la precisión y escala según tus necesidades
            $table->decimal('dineroCartera', 10, 3); // Cambia la precisión y escala según tus necesidades
            $table->unsignedBigInteger('total_clientes')->default(0);
            $table->unsignedBigInteger('total_prestamos')->default(0);
            $table->decimal('total_ganancias', 10, 2)->default(0.0);
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
