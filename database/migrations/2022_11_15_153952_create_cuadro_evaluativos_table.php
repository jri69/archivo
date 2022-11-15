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
        Schema::create('cuadro_evaluativos', function (Blueprint $table) {
            $table->id();
            $table->string('formacion');
            $table->string('cursos_continuo');
            $table->string('experiencia_general');
            $table->string('nacionalidad');
            $table->integer('experiencia_especifica');
            $table->integer('formacion_continua');
            $table->integer('propuesta_tecnica');
            $table->unsignedBigInteger('carta_id');
            $table->foreign('carta_id')->references('id')->on('cartas')->onDelete('cascade');
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
        Schema::dropIfExists('cuadro_evaluativos');
    }
};
