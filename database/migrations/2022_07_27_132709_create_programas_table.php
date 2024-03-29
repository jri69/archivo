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
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->string('sigla');
            $table->string('version', 5);
            $table->string('edicion', 5);
            $table->string('tipo');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->integer('costo');
            $table->integer('hrs_academicas');
            $table->string('cantidad_modulos');
            $table->string('modalidad');
            $table->string('has_grafica')->default('No')->nullable();
            $table->string('has_editable')->default('No')->nullable();
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
        Schema::dropIfExists('programas');
    }
};
