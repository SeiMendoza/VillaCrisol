<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('NombreCompleto');
            $table->string('NúmeroDeIdentidad')->unique();
            $table->string('CorreoElectrónico')->unique();
            $table->string('NúmeroTelefónico')->unique();
            $table->string('NúmeroDeReferencia')->unique();
            $table->string('NombreDeLaReferencia');
            $table->string('Domicilio');
            $table->date('FechaDeIngreso');
            $table->char('Estado');
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
        Schema::dropIfExists('empleados');
    }
}
