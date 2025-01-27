<?php

namespace Tests\Unit;

use App\Models\CitaMedica;
use PHPUnit\Framework\TestCase;

class CitaMedicaTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_creacion_de_una_cita_medica_en_memoria()
    {
        $cita = new CitaMedica(['paciente_id' => 1,'medico_id' => 1,'fecha' => '26/01/2025','hora' => '11:01',]);

        $this->assertEquals(1,$cita->paciente_id);
        $this->assertEquals(1,$cita->medico_id);
        $this->assertEquals('26/01/2025',$cita->fecha);
        $this->assertEquals('11:01',$cita->hora);
    }

    /**
     * Verficar que los fillable este correctos
     */

     public function test_fillable_Cita(){

        $cita = new CitaMedica();
        $this->assertEquals([
            'paciente_id',
            'medico_id',
            'fecha',
            'hora',
        ],$cita->getFillable());
     }
}