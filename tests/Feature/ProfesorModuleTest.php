<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfesorModuleTest extends TestCase
{
    use RefreshDatabase; // <-- IMPORTANTE: Resetea la BD antes de cada prueba

    /**
     * Prueba que la página de la lista de profesores se carga correctamente.
     *
     * @return void
     */
    public function test_profesores_list_page_loads_successfully(): void
    {
        // 1. Acción: Simula una petición GET a la ruta de profesores.
        $response = $this->get('/profesores');

        // 2. Comprobación: Verifica que la respuesta fue exitosa (código 200).
        $response->assertStatus(200);

        // 3. Comprobación: Verifica que la vista contiene el texto 'Profesores Registrados'.
        $response->assertSee('Profesores Registrados');
    }
}