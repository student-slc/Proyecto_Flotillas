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
        Schema::create('mantenimientounidades', function (Blueprint $table) {
            $table->id();
            $table->string('id_unidad');
            $table->string('kmfinales');
            $table->string('fecha');
            $table->string('frecuencia');
            $table->string('sigservicio');
            $table->string('kmfaltantes');
            $table->string('tipomantenimiento');
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
        Schema::dropIfExists('mantenimientounidades');
    }
};
