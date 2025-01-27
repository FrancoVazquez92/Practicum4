<?php

namespace Tests\Unit;

use App\Models\Medico;
use PHPUnit\Framework\TestCase;

class MedicoTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_creacion_de_un_medico_en_memoria()
    {
        $medico = new Medico(['nombre' => 'Enrique','apellido' => 'Ortiz','especialidad' => 'Medicina familiar',]);

        $this->assertEquals('Enrique',$medico->nombre);
        $this->assertEquals('Ortiz',$medico->apellido);
        $this->assertEquals('Medicina familiar',$medico->especialidad);
    }

    /**
     * Verficar que los fillable este correctos
     */

     public function test_fillable_Cita(){

        $medico = new Medico();
        $this->assertEquals([
            'nombre',
            'apellido',
            'especialidad',
        ],$medico->getFillable());
     }
}
