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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('Fecha');
            $table->unsignedBigInteger('ID_Cliente');
            $table->unsignedBigInteger('ID_Trabajador');
            $table->unsignedBigInteger('ID_Servicio');
            $table->foreign('ID_Cliente')->references('ID')->on('clientes')->onDelete('cascade');
            $table->foreign('ID_Trabajador')->references('ID')->on('trabajadores')->onDelete('cascade');
            $table->foreign('ID_Servicio')->references('ID')->on('servicios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
