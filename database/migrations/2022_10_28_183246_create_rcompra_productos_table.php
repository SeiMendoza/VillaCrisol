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
        Schema::create('rcompra_productos', function (Blueprint $table) {
            $table->id();
            $table->string('numfactura')->unique();
            $table->string('proveedor')->nullable();
            $table->integer('impuesto')->nullable();
            $table->string('descripción');
            $table->string('categoria');
            $table->date('fecha');
            $table->integer('total');
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
        Schema::dropIfExists('rcompra_productos');
    }
};
