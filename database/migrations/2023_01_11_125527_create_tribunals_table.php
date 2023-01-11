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
        Schema::create('tribunals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->unsignedBigInteger('titucacion_id');
            $table->foreign('titucacion_id')->references('id')->on('titulacions')->onDelete('cascade');
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
        Schema::dropIfExists('tribunals');
    }
};
