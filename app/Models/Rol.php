<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'rol_id';
    public $timestamps = false;

    public function users():HasMany
    {
        return $this->hasMany(Usuario::class);
    }

}
