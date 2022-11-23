<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombrecompleto');
            $table->string('razonsocial');
            $table->string('direccionfisica');
            $table->string('statuspago');
            $table->string('telefono');
            $table->string('correo');

            $table->string('colonia');
            $table->string('ciudad');
            $table->string('municipio');
            $table->string('estado');
            $table->string('codigopostal');
            $table->string('rfc');
            $table->string('numero');
            $table->string('observaciones');
            $table->string('regimen_fiscal');
            $table->string('sfdi');
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
        Schema::dropIfExists('clientes');
    }
};
