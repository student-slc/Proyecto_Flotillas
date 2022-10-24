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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombrecliente');
            $table->string('fecha');
            $table->string('plaga');
            $table->string('telefonocliente');
            $table->string('tipolugar');
            $table->string('nocuartos');
            $table->string('mtrscuadrados');
            $table->string('tiempoplaga');
            $table->string('quimicousado');
            $table->string('costo');
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
        Schema::dropIfExists('cotizaciones');
    }
};
