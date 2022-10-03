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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('serieunidad');
            $table->string('marca');
            $table->string('submarca');
            $table->string('añounidad');
            $table->string('tipounidad');
            $table->string('razonsocialunidad');
            $table->string('placas');
            $table->string('status');
            $table->string('seguro');
            $table->string('verificacion');
            $table->string('mantenimiento');
            $table->string('operador');
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
        Schema::dropIfExists('unidades');
    }
};
