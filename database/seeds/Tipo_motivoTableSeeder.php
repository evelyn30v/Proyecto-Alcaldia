<?php

use Illuminate\Database\Seeder;

class Tipo_motivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Alimentos',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Regulación de alimentos (Aumento)',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Regulación de alimentos (Disminución)',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Visitas',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Custodia',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Tenencias',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Gastos de estudio',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Exoneración',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Conflicto familiar',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Alimentos adulto mayor',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Disolución de la unión marital de hecho',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Declaración de la unión marital de hecho',
        ]);
        DB::table('tipo_motivos')->insert([
            'nombre' => 'Liquidación de la sociedad patrimonial',
        ]);
    }
}
