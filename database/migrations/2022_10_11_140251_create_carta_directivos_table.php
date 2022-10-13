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
        Schema::create('carta_directivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carta_id')->constrained('cartas')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('directivo_id')->constrained('directivos')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('carta_directivos');
    }
};
