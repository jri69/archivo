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
        Schema::create('estudiante_programas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estudiante');
            $table->foreign('id_estudiante')->references('id')->on('estudiantes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_programa');
            $table->foreign('id_programa')->references('id')->on('programas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('estudiante_programas');
    }
};
