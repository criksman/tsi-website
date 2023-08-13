<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tematica extends Model
{
    use HasFactory;
    protected $table = 'tematicas';
    protected $primaryKey = 'tematica_id';
    public $timestamps = false;

    public function preguntas(): HasMany
    {
        return $this->hasMany(Pregunta::class);
    }

    public function idioma(): BelongsTo
    {
        return $this->belongsTo(Idioma::class);
    }

    public function seccion(): BelongsTo
    {
        return $this->belongsTo(Seccion::class);
    }

    public function dificultad(): BelongsTo
    {
        return $this->belongsTo(Dificultad::class);
    }
}
