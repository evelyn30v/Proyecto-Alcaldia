<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistroDelito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_delitos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->BigInteger('cantidad');
            $table->unsignedBigInteger('tipo_delito');
            // $table->string('tipo_delito');
            $table->string('mes');
            $table->bigInteger('anio');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('tipo_delito')->references('id')->on('tipo_delitos');
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
