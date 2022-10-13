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
        Schema::create('formulario_c1s', function (Blueprint $table) {
            $table->id();
            $table->integer('formacion');
            $table->integer('cursos');
            $table->integer('experiencia');
            $table->integer('nacionalidad');
            // foreing key con contrato
            $table->foreignId('contrato_id')->constrained('contratos')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('formulario_c1s');
    }
};
