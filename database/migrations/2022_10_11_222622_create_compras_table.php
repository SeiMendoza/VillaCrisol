<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->integer('numeroFactura')->unique();
            $table->string('nombreCompra');
            $table->date('fecha');
            $table->integer('cantidad');
            $table->double('precio');
            $table->double('total');
            $table->string('observacion')->nullable();
            $table->string('imagenFactura')->nullable();
            $table->string('fechaRegistro')->nullable();
            $table->string('usuario')->nullable();
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
        Schema::dropIfExists('compras');
    }
}
