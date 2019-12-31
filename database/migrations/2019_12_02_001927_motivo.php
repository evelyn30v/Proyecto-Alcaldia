<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Motivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_ciudad');
            $table->unsignedBigInteger('id_tipo_motivo');
            $table->unsignedBigInteger('id_tipo_delito');
            $table->timestamps();

            $table->foreign('id_ciudad')->references('id')->on('ciudads');
            $table->foreign('id_tipo_motivo')->references('id')->on('tipo_motivos');
            $table->foreign('id_tipo_delito')->references('id')->on('tipo_delitos');
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
