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
        Schema::create('cartas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_admi')->nullable();
            $table->string('contrato_admi')->nullable();
            $table->date('fecha');
            $table->date('fecha_plazo')->nullable();
            $table->string('campo_adicional_uno')->nullable();
            $table->string('campo_adicional_dos')->nullable();
            $table->string('campo_adicional_tres')->nullable();
            $table->string('campo_adicional_cuatro')->nullable();
            $table->string('campo_adicional_cinco')->nullable();
            $table->string('campo_adicional_seis')->nullable();
            $table->unsignedBigInteger('tipo_id')->nullable();
            $table->foreign('tipo_id')->references('id')->on('tipo_cartas')->onDelete('cascade');
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
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
        Schema::dropIfExists('cartas');
    }
};
