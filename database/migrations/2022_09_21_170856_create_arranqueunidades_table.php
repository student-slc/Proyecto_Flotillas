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
        Schema::create('arranqueunidades', function (Blueprint $table) {
            $table->id();
            $table->string('id_operador');
            $table->string('id_unidad');
            $table->string('id_flotilla');
            $table->string('eco');
            $table->string('kmarranque');
            $table->string('combustible');
            $table->string('llantarefaccion');
            $table->string('crucetaygato');
            $table->string('lonas');
            $table->string('cuerdas');
            $table->string('exterior');
            $table->string('banderin');
            $table->string('firma');
            $table->string('fotoreporte');
            $table->string('status');
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
        Schema::dropIfExists('arranqueunidades');
    }
};
