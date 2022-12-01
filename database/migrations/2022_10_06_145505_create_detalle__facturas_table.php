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
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factura_id');
            $table->unsignedBigInteger('primero');
            $table->unsignedBigInteger('segundo');
            $table->unsignedBigInteger('tercero')->nullable();
            $table->string('cuarto')->nullable();
            $table->string('quinto')->nullable();
            $table->integer('cantidad');
            $table->string('detalle');
            $table->double('precio_unitario');
            $table->double('subtotal');
            $table->timestamps();

            $table->foreign('factura_id')->on('facturas')->references('id');
            $table->foreign('primero')->on('partidas')->references('id');
            $table->foreign('segundo')->on('sub_partidas')->references('id');
            $table->foreign('tercero')->on('third_partidas')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_facturas');
    }
};