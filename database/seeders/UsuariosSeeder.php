<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['email' => 'admin1@gmail.com','password' => Hash::make('1234'),'usuario_id'=>'Admin 1', 'rol_id'=>1, 'foto'=>'foto.jpg', 'estado' => true],           
        ]);
    }
}
