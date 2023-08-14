<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Idioma extends Model
{
    use HasFactory;
    protected $table = 'idiomas';
    protected $primaryKey = 'idioma_id';
    public $timestamps = false;

    public function tematicas(): HasMany
    {
        return $this->hasMany(Tematica::class, 'idioma_id');
    }
}
