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
        Schema::create('administrativos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('ci')->unique();
            $table->string('expedicion', 2);
            $table->string('contrato');
            $table->string('fecha_ingreso');
            $table->string('fecha_retiro')->nullable();
            $table->string('sueldo')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedInteger('cargo_id');
            $table->timestamps();

            $table->foreign('cargo_id')->on('cargos')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrativos');
    }
};
