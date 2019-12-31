<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class remision extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('remisions')->insert([
            'nombre' => 'No remitido',
        ]);
        DB::table('remisions')->insert([
            'nombre' => 'ICBF',
        ]);
        DB::table('remisions')->insert([
            'nombre' => 'Fiscalía',
        ]);
    }
}
