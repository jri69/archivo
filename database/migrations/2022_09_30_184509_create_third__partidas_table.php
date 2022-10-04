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
        Schema::create('third_partidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('second_partida_id');
            $table->integer('codigo');
            $table->string('nombre');
            $table->timestamps();

            $table->foreign('second_partida_id')->on('sub_partidas')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('third__partidas');
    }
};
