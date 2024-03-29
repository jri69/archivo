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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('honorario');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->text('horarios')->nullable();
            $table->boolean('pagado')->default(false);
            $table->string('nro_preventiva')->nullable();
            $table->string('comprobante')->nullable();
            $table->string('dir_comprobante')->nullable();
            // foreing key con modulo
            $table->foreignId('modulo_id')->constrained('modulos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('contratos');
    }
};
