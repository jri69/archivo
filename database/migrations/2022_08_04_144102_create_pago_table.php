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
        Schema::create('pago', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pago_estudiante_id');
            $table->integer('monto');
            $table->date('fecha');
            $table->string('comprobante');
            $table->string('compro_file');
            $table->unsignedBigInteger('tipo_pago_id')->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('pago_estudiante_id')->on('pago_estudiante')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tipo_pago_id')->on('tipo_pagos')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago');
    }
};