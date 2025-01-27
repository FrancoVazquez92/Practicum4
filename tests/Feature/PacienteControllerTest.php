<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Paciente;
use Tests\TestCase;

class PacienteControllerTest extends TestCase
{
    /**
     * Errores codigos http - 200 
     */

     // Limpiar la base de datos en cada test

     //use RefreshDatabase;

     public function test_lista_pacientes_devuelve_estado_200()
     {
 
         // Crear citas en una base de datos de pruebas
 
         Paciente::factory()->count(3)->create();
 
         // Realizar una solicitud get al index.
         $response= $this->get(route('pacientes.index'));
 
         // Verificar si me devuelve un 200 OK
         $response->assertStatus(200);
 
         // Verificar un mensaje en HTML
 
         $response->assertSeeText('Pacientes');
         
     }
}