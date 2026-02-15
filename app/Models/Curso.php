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
    
    public function director()
    {
        return $this->belongsTo(Profesor::class, 'director_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'curso_id');
    }
}
