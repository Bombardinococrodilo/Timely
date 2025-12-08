<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'profesor_id',
        'curso_id',
        'asignatura_id',
        'espacio_id', 
        'dia',
        'hora_inicio',
        'hora_fin',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignaturas::class, 'asignatura_id');
    }

    public function espacio()
    {
        return $this->belongsTo(Espacios::class, 'espacio_id');
    }
}