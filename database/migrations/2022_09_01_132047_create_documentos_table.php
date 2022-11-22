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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo');
            $table->string('dir');
            $table->unsignedBigInteger('movimiento_doc_id')->nullable();
            $table->foreign('movimiento_doc_id')->references('id')->on('movimiento_docs')->onDelete('cascade');
            $table->unsignedBigInteger('recepcion_id')->nullable();
            $table->foreign('recepcion_id')->references('id')->on('recepcions')->onDelete('cascade');
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
        Schema::dropIfExists('documentos');
    }
};
