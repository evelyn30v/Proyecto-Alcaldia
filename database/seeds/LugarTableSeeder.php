<?php

use Illuminate\Database\Seeder;

class LugarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lugars')->insert([
            'nombre' => 'Centro de Convivencia Ciudadana',
        ]);
    }
}
