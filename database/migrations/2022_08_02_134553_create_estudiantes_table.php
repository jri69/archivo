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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('honorifico');
            $table->string('nombre');
            $table->string('numero_registro')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('telefono')->nullable();
            $table->string('cedula')->unique()->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('sexo');
            $table->string('expedicion', 2);
            $table->string('carrera');
            $table->string('universidad');
            $table->string('estado')->nullable();
            $table->date('fecha_inactividad')->nullable();
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
        Schema::dropIfExists('estudiantes');
    }
};
