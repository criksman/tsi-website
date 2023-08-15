<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DificultadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dificultades')->insert([
            ['nombre' => 'Facil', 'descripcion' => '(En construcción)'],
            ['nombre' => 'Medio', 'descripcion' => '(En construcción)'],   
            ['nombre' => 'Dificil', 'descripcion' => '(En construcción)'],              
        ]);
    }
}
