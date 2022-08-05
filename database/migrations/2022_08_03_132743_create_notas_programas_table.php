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
        Schema::create('notas_programas', function (Blueprint $table) {
            $table->id();
            $table->string('nota');
            $table->text('observaciones');
            $table->unsignedBigInteger('id_estudiante_programa');
            $table->foreign('id_estudiante_programa')->references('id')->on('estudiante_programas');
            $table->unsignedBigInteger('id_modulo');
            $table->foreign('id_modulo')->references('id')->on('modulos');
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
        Schema::dropIfExists('notas_programas');
    }
};
