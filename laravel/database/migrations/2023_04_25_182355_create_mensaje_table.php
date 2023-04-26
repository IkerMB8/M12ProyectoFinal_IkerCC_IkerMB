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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->text('Contenido');
            $table->unsignedBigInteger('ID_Chat');
            $table->unsignedBigInteger('ID_Cliente');
            $table->unsignedBigInteger('ID_Trabajador');
            $table->foreign('ID_Chat')->references('ID')->on('chats')->onDelete('cascade');
            $table->foreign('ID_Cliente')->references('ID')->on('clientes')->onDelete('cascade');
            $table->foreign('ID_Trabajador')->references('ID')->on('trabajadores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
