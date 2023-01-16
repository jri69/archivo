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
        Schema::create('titulacions', function (Blueprint $table) {
            $table->id();
            $table->text('tesis');
            $table->string('director')->nullable();
            $table->text('lineas_academicas')->nullable();
            $table->string('originalidad')->nullable();
            $table->string('similitud')->nullable();
            $table->text('aporte_academico')->nullable();
            $table->string('grado_academico')->nullable();
            $table->string('fecha_ini')->nullable();
            $table->string('fecha_fin')->nullable();
            $table->string('dia_defensa')->nullable();
            $table->string('hora_defensa')->nullable();
            $table->text('aporte')->nullable();
            $table->text('eje_tematico')->nullable();
            $table->unsignedBigInteger('programa_id');
            $table->foreign('programa_id')->references('id')->on('programas')->onDelete('cascade');
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
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
        Schema::dropIfExists('titulacions');
    }
};
