<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Tipo_usuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Tipo_usuarios')->insert([
            'nombre' => '1',
        ]);
        DB::table('Tipo_usuarios')->insert([
            'nombre' => '2',
        ]);
        DB::table('Tipo_usuarios')->insert([
            'nombre' => '3',
        ]);
    }
}
