
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
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('dinero_global');
            $table->bigInteger('dineroCartera');
            $table->unsignedBigInteger('total_clientes')->default(0);
            $table->bigInteger('total_prestamos')->default(0);
            $table->bigInteger('total_ganancias')->default(0);
            $table->bigInteger('sumaCuotasHoy')->default(0);
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
