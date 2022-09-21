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
        Schema::create('verificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('id_unidad');
            $table->string('fechavencimiento');
            $table->string('tipoverificacion');
            $table->string('subtipoverificacion');
            $table->string('ultimaverificacion');
            $table->string('caratulaverificacion');
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
        Schema::dropIfExists('_verificaciones');
    }
};
