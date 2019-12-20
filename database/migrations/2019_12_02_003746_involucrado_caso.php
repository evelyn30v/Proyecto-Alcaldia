<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvolucradoCaso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caso_involucrados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_registro_caso');
            $table->unsignedBigInteger('id_involucrado');
            $table->timestamps();

            $table->foreign('id_registro_caso')->references('id')->on('registro_casos');
            $table->foreign('id_involucrado')->references('id')->on('involucrados');
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
