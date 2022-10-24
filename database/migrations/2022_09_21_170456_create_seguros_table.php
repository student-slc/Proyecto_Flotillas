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
        Schema::create('seguros', function (Blueprint $table) {
            $table->id();
            $table->string('nopoliza');
            $table->string('id_unidad');
            $table->string('fechavencimiento');
            $table->string('fechainicio');
            $table->string('tiposeguro');
            $table->string('caratulaseguro');
            $table->string('provedor');
            $table->string('precio');
            $table->string('impuestos');
            $table->string('costototal');
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
        Schema::dropIfExists('seguros');
    }
};
