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
        Schema::create('comida_bebidas', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Descripción');
            $table->string('Tipo');
            $table->integer('Precio');
            $table->string('Tamaño');
            $table->string('Imagen');
            $table->string('Activo')->default('si');
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
        Schema::dropIfExists('comida_bebidas');
    }
};
