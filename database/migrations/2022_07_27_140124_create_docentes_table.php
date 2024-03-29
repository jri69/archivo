<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Ramsey\Uuid\v1;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('honorifico')->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('foto');
            $table->string('cv');
            $table->string('correo')->unique()->nullable();
            $table->string('cedula')->nullable();
            $table->string('expedicion', 2)->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('facturacion')->default(false);
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
        Schema::dropIfExists('docentes');
    }
};
