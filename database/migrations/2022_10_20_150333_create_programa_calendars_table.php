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
        Schema::create('programa_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Sigla
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->string('nombre')->nullable(); // nombre completo
            $table->string('tipo')->nullable();
            $table->string('tipo_fecha')->nullable();

            $table->string('modalidad')->nullable();
            $table->string('docente')->nullable();
            
            $table->string('lugar')->nullable();
            $table->string('hora')->nullable();
            $table->string('encargado')->nullable();
            $table->unsignedBigInteger('programa_id')->nullable();
            $table->unsignedBigInteger('modulo_id')->nullable();
            $table->unsignedBigInteger('evento_id')->nullable();
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
        Schema::dropIfExists('programa_calendars');
    }
};
