<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Involucrado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('involucrados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rol');
            $table->string('nombre');
            $table->unsignedBigInteger('id_pais');
            $table->unsignedBigInteger('id_registro_caso');
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('enfoque_diferencial');
            $table->string('estado_civil');
            $table->string('grado_escolaridad');
            $table->string('salud_empresa');
            $table->string('tipo_documento');
            $table->string('no_documento');
            $table->date('fecha_exp_documento');
            $table->string('estrato');
            $table->string('correo');
            $table->unsignedBigInteger('id_ciudad_contacto');
            $table->string('direccion_contacto');
            $table->timestamps();

            $table->foreign('id_ciudad_contacto')->references('id')->on('ciudads');
            $table->foreign('id_registro_caso')->references('id')->on('registro_casos');
            $table->foreign('id_pais')->references('id')->on('pais');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
