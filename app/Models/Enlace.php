<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enlace extends Model
{
    use HasFactory;
    protected $table = 'enlaces';
    protected $primaryKey = 'enlace_id';
    public $timestamps = false;

    public function tematica(): BelongsTo
    {
        return $this->belongsTo(Tematica::class, 'enlace_id');
    }

}
