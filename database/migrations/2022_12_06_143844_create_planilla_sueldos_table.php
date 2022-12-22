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
        Schema::create('planilla_sueldos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('administrativo_id');
            $table->string('horas_faltas');
            $table->double('sueldo_basico');
            $table->double('total_ganado');
            $table->double('sueldo_total');
            $table->boolean('facturacion')->default(false);
            $table->string('factura');
            $table->timestamps();

            $table->foreign('administrativo_id')->on('administrativos')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planilla_sueldos');
    }
};