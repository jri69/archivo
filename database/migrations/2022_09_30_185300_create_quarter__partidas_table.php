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
        Schema::create('quarter_partidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('third_partida_id');
            $table->integer('codigo');
            $table->string('nombre');
            $table->timestamps();

            $table->foreign('third_partida_id')->on('third_partidas')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quarter_partidas');
    }
};
