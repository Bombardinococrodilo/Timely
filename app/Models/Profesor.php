<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profesor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'profesores';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var list<string>
     */ 

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'especialidad',
    ];
}