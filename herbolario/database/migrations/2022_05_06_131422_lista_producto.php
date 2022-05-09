<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_producto', function (Blueprint $table){
            $table->id();
            $table->foreignId('id_usuario')->references('id')->on('users');
            $table->foreignId('id_producto')->references('id')->on('productos');
            $table->foreignId('id_comanda')->nullable()->references('id')->on('comanda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lista_producto');
    }
}
