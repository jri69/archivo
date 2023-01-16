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
        Schema::create('carta_titulacions', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_admi')->nullable();
            $table->string('fecha')->nullable();
            $table->string('consupo')->nullable();
            $table->string('exceso')->nullable();
            $table->string('poa')->nullable();
            $table->string('apertura')->nullable();
            $table->string('codigo_partida')->nullable();
            $table->string('is_docente')->nullable();
            $table->text('articulo')->nullable();
            $table->text('profesion')->nullable();
            $table->string('codigo1')->nullable();
            $table->string('codigo2')->nullable();
            $table->string('codigo3')->nullable();
            $table->string('directorTFG')->nullable();
            $table->string('documento')->nullable();
            $table->string('otro')->nullable();
            $table->unsignedBigInteger('titulacion_id');
            $table->foreign('titulacion_id')->references('id')->on('titulacions')->onDelete('cascade');
            $table->unsignedBigInteger('tipo_id')->nullable();
            $table->foreign('tipo_id')->references('id')->on('tipo_cartas')->onDelete('cascade');
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
        Schema::dropIfExists('carta_titulacions');
    }
};
