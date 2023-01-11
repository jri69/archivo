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
        Schema::create('titulacion_directivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('titulacion_id');
            $table->foreign('titulacion_id')->references('id')->on('titulacions')->onDelete('cascade');
            $table->unsignedBigInteger('directivo_id');
            $table->foreign('directivo_id')->references('id')->on('directivos')->onDelete('cascade');
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
        Schema::dropIfExists('titulacion_directivos');
    }
};
