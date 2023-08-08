<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class Usuario extends Authenticable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'usuario_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
}
