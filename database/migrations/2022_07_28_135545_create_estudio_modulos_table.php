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
        Schema::create('estudio_modulos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_estudio_id');
            $table->unsignedBigInteger('modulo_id');
            
            $table->foreign('tipo_estudio_id')->references('id')->on('tipo_estudios');
            $table->foreign('modulo_id')->references('id')->on('modulos');
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
        Schema::dropIfExists('estudio_modulos');
    }
};
