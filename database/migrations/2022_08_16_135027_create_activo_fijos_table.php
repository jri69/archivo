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
        Schema::create('activo_fijos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->text('descripcion');
            $table->string('unidad');
            $table->string('estado');
            $table->string('tipo');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->unsignedBigInteger("id_area");
            $table->foreign('id_area')->references('id')->on('area');
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
        Schema::dropIfExists('activo_fijos');
    }
};
