<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asignaturas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'asignaturas';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var list<string>
     */ 

    protected $fillable = [
        'nombre',
        'descripcion',
        'profesor_asignado',
        'horas_semanales',
        'tipo_materia',
    ];  
}
