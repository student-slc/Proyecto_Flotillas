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
        Schema::create('fumigaciones', function (Blueprint $table) {
            $table->id();
            $table->string('id_cliente');
            $table->string('id_fumigador');
            $table->string('fechaprogramada');
            $table->string('fechaultimafumigacion');
            $table->string('lugardelservicio');
            $table->string('status');
            $table->string('numerodevisitas');
            $table->string('costo');
            $table->string('satisfaccionservicio');
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
        Schema::dropIfExists('fumigaciones');
    }
};
