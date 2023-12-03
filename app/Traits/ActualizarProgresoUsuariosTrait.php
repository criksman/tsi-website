<?php

namespace App\Traits;
use App\Models\Idioma;
use App\Models\Dificultad;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;

trait ActualizarProgresoUsuariosTrait {
    public function actualizarProgresoUsuarios(Idioma $idioma, Dificultad $dificultad)
    {
        $idioma_id = $idioma->idioma_id;
        $dificultad_id = $dificultad->dificultad_id; 

        $totalTematicas = $idioma->tematicas()->where('dificultad_id', $dificultad_id)->where('idioma_id', $idioma_id)->where('estado', true)->count();

        $usuarios = Usuario::all();

        foreach ($usuarios as $usuario) {
            $user_id = $usuario->user_id;

            $tematicasAprobadas = $usuario->tematicasConPivot()->where('tematicas.dificultad_id', $dificultad_id)->where('tematicas.idioma_id', $idioma_id)->wherePivot('progreso', '>=', 55)->count();
            
            if ($totalTematicas > 0) {
                $promedioProgreso = ($tematicasAprobadas / $totalTematicas) * 100;
            } else {
                $promedioProgreso = 0;
            }
            
            $progresoExistente = DB::table('dificultad_idioma_user')
                ->where('dificultad_id', $dificultad_id)
                ->where('idioma_id', $idioma_id)
                ->where('user_id', $user_id)
                ->first();
            
            if ($progresoExistente) {
                DB::table('dificultad_idioma_user')
                    ->where('dificultad_id', $dificultad_id)
                    ->where('idioma_id', $idioma_id)
                    ->where('user_id', $user_id)
                    ->update(['progreso' => $promedioProgreso]);
            } else {
                $usuario->progresoDificultadIdioma()->attach($dificultad_id ,['progreso' => $promedioProgreso, 'idioma_id' => $idioma_id, 'user_id' => $user_id]);
            }
        }
    }
}