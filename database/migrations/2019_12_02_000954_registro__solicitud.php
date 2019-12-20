<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegistroSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_solicituds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('motivo');
            $table->enum('estado',['pendiente','resuelto']);
            $table->text('observacion')->nullable();
            $table->date('fecha');
            $table->unsignedBigInteger('id_solicitante');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
            
            $table->foreign('id_solicitante')->references('id')->on('solicitantes');
            $table->foreign('id_user')->references('id')->on('users');
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
