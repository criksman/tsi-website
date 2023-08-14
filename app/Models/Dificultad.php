<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dificultad extends Model
{
    use HasFactory;
    protected $table = 'dificultades';
    protected $primaryKey = 'dificultad_id';
    public $timestamps = false;

    public function tematicas(): HasMany
    {
        return $this->hasMany(Tematica::class, 'tematica_id');
    }
}
