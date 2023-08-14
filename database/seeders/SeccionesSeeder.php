<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('secciones')->insert([
            ['nombre' => 'Escrito', 'descripcion' => '(En construcción)'],
            ['nombre' => 'Listening', 'descripcion' => '(En construcción)'],              
        ]);
    }
}
