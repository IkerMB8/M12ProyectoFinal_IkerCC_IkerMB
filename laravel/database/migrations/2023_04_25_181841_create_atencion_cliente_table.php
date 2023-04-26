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
        Schema::create('atenciones_cliente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Trabajador');
            $table->unsignedBigInteger('ID_Cliente');
            $table->foreign('ID_Trabajador')->references('ID')->on('trabajadores')->onDelete('cascade');
            $table->foreign('ID_Cliente')->references('ID')->on('clientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atenciones_cliente');
    }
};
