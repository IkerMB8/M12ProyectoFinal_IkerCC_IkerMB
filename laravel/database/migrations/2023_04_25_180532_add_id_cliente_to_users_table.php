<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdClienteToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Cliente')->nullable();
            $table->foreign('ID_Cliente')->references('ID')->on('clientes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['ID_Cliente']);
            $table->dropColumn('ID_Cliente');
        });
    }
}