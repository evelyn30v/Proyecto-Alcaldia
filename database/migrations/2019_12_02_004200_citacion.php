<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Citacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('observacion')->nullable();
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->unsignedBigInteger('id_lugar');
            $table->unsignedBigInteger('id_registro_caso');
            $table->timestamps();

            $table->foreign('id_lugar')->references('id')->on('lugars');
            $table->foreign('id_registro_caso')->references('id')->on('registro_casos');
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
