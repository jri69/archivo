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
        Schema::create('pago_estudiante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('programa_id');
            $table->integer('cant_modulos');            
            $table->unsignedBigInteger('tipo_descuento_id');
            $table->integer('convalidacion')->nullable(); 
            $table->timestamps();

            $table->foreign('estudiante_id')->on('estudiantes')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('programa_id')->on('programas')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_descuento_id')->on('tipo_descuento')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_estudiante');
    }
};
