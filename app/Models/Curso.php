<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['grado', 'grupo', 'nivel', 'cantidad_estudiantes'];

    public function getNombreCompletoAttribute()
    {
        return "{$this->grado} - {$this->grupo}";
    }
    
}
