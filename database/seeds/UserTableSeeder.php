<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            'perfil'=>'',
            'name' => 'usuario1',
            'apellido'=>'',
            'cedula' => '1234567891',
            'celular' => '1234567891',
            'tipo_usuario_id' => 1,
            'email' => 'usuario1@gmail.com',
            'password' => bcrypt('usuario12456'),
        ]);
        DB::table('Users')->insert([
            'perfil'=>'',
            'name' => 'usuario2',
            'apellido'=>'',
            'cedula' => '1234567891',
            'celular' => '1234567891',
            'tipo_usuario_id' => 2,
            'email' => 'usuario2@gmail.com',
            'password' => bcrypt('usuario12456'),
        ]);
        DB::table('Users')->insert([
            'perfil'=>'',
            'name' => 'usuario3',
            'apellido'=>'',
            'cedula' => '1234567891',
            'celular' => '1234567891',
            'tipo_usuario_id' => 3,
            'email' => 'usuario3@gmail.com',
            'password' => bcrypt('usuario12456'),
        ]);
    }
}
