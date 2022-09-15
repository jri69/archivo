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
        Schema::create('movimiento_docs', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->date('fecha');
            $table->string('departamento');
            $table->text('descripcion')->nullable();
            $table->string('confirmacion')->default('Sin confirmar');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('recepcion_id');
            $table->foreign('recepcion_id')->references('id')->on('recepcions');
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
        Schema::dropIfExists('movimiento_docs');
    }
};
