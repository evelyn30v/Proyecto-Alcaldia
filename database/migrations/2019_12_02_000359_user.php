<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('perfil')->nullable();
            $table->string('name');
            $table->string('apellido');
            $table->string('cedula');
            $table->string('celular');
            $table->unsignedBigInteger('tipo_usuario_id');
            $table->string('email')->unique();
            $table->string('password');
            // $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('tipo_usuario_id')->references('id')->on('tipo_usuarios');
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
