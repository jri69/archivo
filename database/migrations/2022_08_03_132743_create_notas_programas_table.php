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
            $table->unsignedBigInteger('id_estudiante');
            $table->foreign('id_estudiante')->references('id')->on('estudiantes');
            $table->unsignedBigInteger('id_programa');
            $table->foreign('id_programa')->references('id')->on('programas');
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
