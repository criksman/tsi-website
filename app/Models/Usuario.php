<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Usuario extends Authenticable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    public function rol():BelongsTo
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function tematicas():BelongsToMany{
        return $this->belongsToMany(Tematica::class, 'tematica_user', 'user_id', 'tematica_id');
    }

    public function tematicasConPivot():BelongsToMany{
        return $this->belongsToMany(Tematica::class, 'tematica_user', 'user_id', 'tematica_id')->withPivot(['progreso']);
    }

    public function progresoDificultadIdioma():BelongsToMany{
        return $this->belongsToMany(Dificultad::class, 'dificultad_idioma_user', 'user_id', 'dificultad_id', 'idioma_id');
    }
    
    public function progresoDificultadIdiomaConPivot():BelongsToMany{
        return $this->belongsToMany(Dificultad::class, 'dificultad_idioma_user', 'user_id', 'dificultad_id', 'idioma_id')->withPivot(['progreso']);
    }
}
