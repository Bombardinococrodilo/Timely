<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profesor;
use App\Models\Curso;
use App\Models\Asignaturas; 
use App\Models\Espacios; 
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_ES'); 

        User::updateOrCreate(
            ['email' => 'admin@timely.com'],
            [
                'name' => 'Coordinador Académico',
                'password' => bcrypt('password'),
            ]
        );

        $especialidades = ['Desarrollo de Software', 'Matemáticas', 'Inglés Técnico', 'Redes y Sistemas', 'Bases de Datos', 'Ética y Comunicación', 'Física', 'Emprendimiento'];
        
        $profesores = [
            ['nombre' => 'Hernán Felipe', 'apellido' => 'Calderón', 'email' => 'hernan@sena.edu.co', 'especialidad' => 'Software'],
            ['nombre' => 'Martha', 'apellido' => 'Riaño', 'email' => 'martha@sena.edu.co', 'especialidad' => 'Matemáticas'],
            ['nombre' => 'Carlos', 'apellido' => 'Pérez', 'email' => 'carlos@sena.edu.co', 'especialidad' => 'Inglés'],
        ];

        for ($i = 0; $i < 12; $i++) {
            $profesores[] = [
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'especialidad' => $faker->randomElement($especialidades),
            ];
        }
        Profesor::insert($profesores);

        $cursos = [];
        $grados = ['9', '10', '11', 'ADSO', 'SISTEMAS'];
        $grupos = ['A', 'B', 'C'];

        foreach ($grados as $grado) {
            foreach ($grupos as $grupo) {

            if (count($cursos) < 12) {
                    $cursos[] = [
                        'grado' => $grado,
                        'grupo' => $grupo,
                        'cantidad_estudiantes' => $faker->numberBetween(25, 35) 
                    ];
                }
            }
        }
        Curso::insert($cursos);

        $nombresAsignaturas = [
            'Programación Orientada a Objetos', 'Bases de Datos Relacionales', 'Desarrollo Frontend', 
            'Desarrollo Backend en PHP', 'Inglés Técnico I', 'Inglés Técnico II', 'Cálculo Diferencial', 
            'Matemáticas Básicas', 'Física Mecánica', 'Ética Profesional', 'Redes de Computadores', 
            'Mantenimiento de Equipos', 'Lógica de Programación', 'Emprendimiento', 'Salud Ocupacional', 
            'Diseño de Interfaces (UI/UX)', 'Gestión de Proyectos', 'Estructura de Datos', 'Sistemas Operativos', 'Soporte Técnico'
        ];

        $asignaturas = [];
        foreach ($nombresAsignaturas as $index => $nombre) {
            $asignaturas[] = [
                'nombre' => $nombre,
                'descripcion' => 'Asignatura orientada al desarrollo de competencias técnicas y blandas.',
                'profesor_asignado' => (string) $faker->numberBetween(1, 15), 
                'horas_semanales' => '4', // <-- ¡AQUÍ ESTÁ LA SOLUCIÓN (Dato obligatorio)!
            ];
        }
        Asignaturas::insert($asignaturas);

        // 5. CREAR 10 AMBIENTES/ESPACIOS DE APRENDIZAJE
        $nombresEspacios = [
            'Sala de Sistemas 1', 'Sala de Sistemas 2', 'Laboratorio de Software', 
            'Aula Múltiple 101', 'Aula Múltiple 102', 'Laboratorio de Redes', 
            'Auditorio Principal', 'Aula de Bilingüismo', 'Taller de Mantenimiento', 'Aula 201'
        ];

        $espacios = [];
        foreach ($nombresEspacios as $nombre) {
            $espacios[] = [
                'nombre' => $nombre,
                'tipo' => str_contains($nombre, 'Sala') || str_contains($nombre, 'Laboratorio') ? 'Laboratorio' : 'Aula Regular',
                'capacidad' => $faker->numberBetween(30, 40),
                'ubicacion' => 'Bloque ' . $faker->randomElement(['A', 'B', 'C']), // <-- ¡AQUÍ ESTÁ LA OTRA SOLUCIÓN!
            ];
        }
        
        DB::table('espacios')->insert($espacios);

    }
}