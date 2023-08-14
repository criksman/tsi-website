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
            ['nombre' => 'facil', 'descripcion' => '(En construcción)'],
            ['nombre' => 'medio', 'descripcion' => '(En construcción)'],   
            ['nombre' => 'dificil', 'descripcion' => '(En construcción)'],              
        ]);
    }
}
