<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profesor;
use App\Models\Curso;
use App\Models\Asignaturas; 
use App\Models\Espacios;    
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       
        User::updateOrCreate(
            ['email' => 'admin@timely.com'],
            [
                'name' => 'Coordinador Académico',
                'password' => bcrypt('password'),
            ]
        );

        
        Profesor::insert([
            ['nombre' => 'Hernán', 'apellido' => 'Calderón', 'email' => 'hernan@sena.edu.co', 'especialidad' => 'Software'],
            ['nombre' => 'Martha', 'apellido' => 'Riaño', 'email' => 'martha@sena.edu.co', 'especialidad' => 'Matemáticas'],
            ['nombre' => 'Carlos', 'apellido' => 'Pérez', 'email' => 'carlos@sena.edu.co', 'especialidad' => 'Inglés'],
        ]);

        Curso::insert([
            ['grado' => '11', 'grupo' => 'A', 'cantidad_estudiantes' => 30],
            ['grado' => '10', 'grupo' => 'B', 'cantidad_estudiantes' => 28],
            ['grado' => '9', 'grupo' => '1', 'cantidad_estudiantes' => 35],
        ]);

        $asignaturas = ['Matemáticas', 'Programación', 'Inglés', 'Ética', 'Física'];
        foreach($asignaturas as $asig) {
            Asignaturas::create([
                'nombre' => $asig,
                'descripcion' => 'Asignatura base del plan de estudios', 
                'profesor_asignado' => 1, 
            ]);
        }

        try {
            Espacio::create(['nombre' => 'Sala de Sistemas 1', 'tipo' => 'Laboratorio', 'capacidad' => 30]);
            Espacio::create(['nombre' => 'Aula 204', 'tipo' => 'Aula', 'capacidad' => 40]);
            Espacio::create(['nombre' => 'Auditorio', 'tipo' => 'Multiple', 'capacidad' => 100]);
        } catch (\Exception $e) {
        }
    }
}