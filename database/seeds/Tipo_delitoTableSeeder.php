<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Tipo_delitoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_delitos')->insert([
            'nombre' => 'Homicidio',
        ]);
        DB::table('tipo_delitos')->insert([
            'nombre' => 'Hurto a personas',
        ]);
        DB::table('tipo_delitos')->insert([
            'nombre' => 'Hurto a comercio',
        ]);
        DB::table('tipo_delitos')->insert([
            'nombre' => 'Hurto a residencias',
        ]);
        DB::table('tipo_delitos')->insert([
            'nombre' => 'Hurto de automotores',
        ]);
        DB::table('tipo_delitos')->insert([
            'nombre' => 'Extorsión',
        ]);
        DB::table('tipo_delitos')->insert([
            'nombre' => 'Violencia a niños y adolescentes',
        ]);
        DB::table('tipo_delitos')->insert([
            'nombre' => 'Vioilencia al adulto mayor',
        ]);
        DB::table('tipo_delitos')->insert([
            'nombre' => 'Vioilencia de pareja',
        ]);
    }
}
