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
            $table->date('fecha');
            $table->date('fecha_plazo')->nullable();
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipo_cartas')->onDelete('cascade');
            $table->unsignedBigInteger('contrato_id');
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
