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
        Schema::create('lineas_compra', function (Blueprint $table) {
            $table->integer('NumLinea');
            $table->unsignedBigInteger('ID_Compra');
            $table->integer('Cantidad');
            $table->decimal('Descuento', 10, 2);
            $table->string('ID_Producto');
            $table->primary(['NumLinea', 'ID_Compra']);
            $table->foreign('ID_Compra')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('ID_Producto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineas_compra');
    }
};
