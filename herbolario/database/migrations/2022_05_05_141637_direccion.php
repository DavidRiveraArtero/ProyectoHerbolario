<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Direccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table){
            $table->id();
            $table->foreignId('id_usuario')->references('id')->on('users');
            $table->string('nombre');
            $table->string('pais');
            $table->string('telefono');
            $table->string('linea_direccion');
            $table->string('codigo_postal');
            $table->string('ciudad');
            $table->string('provincia');
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
        Schema::dropIfExists('direcciones');
    }
}
