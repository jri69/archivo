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
            $table->string('nombre', 50);
            $table->string('sigla', 10);
            $table->string('version', 5);
            $table->string('edicion', 5);
            $table->string('fecha_inicio');
            $table->string('fecha_finalizacion');
            $table->integer('costo');
            $table->string('cantidad_modulos');
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
