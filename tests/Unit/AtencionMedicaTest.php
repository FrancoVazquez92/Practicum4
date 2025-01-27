<?php

namespace Tests\Unit;

use App\Models\AtencionMedica;
use PHPUnit\Framework\TestCase;

class AtencionMedicaTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_creacion_de_una_atencion_medica_en_memoria()
    {
        $atencion = new AtencionMedica(['cita_medica_id'=>1,'paciente_nombre' => 'Franco','medico_nombre' => 'Jose','diagnostico' => 'Gripe','tratamiento' => 'Medicina', 'receta' => 'Singripal']);

        $this->assertEquals(1,$atencion->cita_medica_id);
        $this->assertEquals('Franco',$atencion->paciente_nombre);
        $this->assertEquals('Jose',$atencion->medico_nombre);
        $this->assertEquals('Gripe',$atencion->diagnostico);
        $this->assertEquals('Medicina',$atencion->tratamiento);
        $this->assertEquals('Singripal',$atencion->receta);
    }

    /**
     * Verficar que los fillable este correctos
     */

     public function test_fillable_Cita(){

        $atencion = new AtencionMedica();
        $this->assertEquals([
            'cita_medica_id',
            'paciente_nombre',
            'medico_nombre',
            'diagnostico',
            'tratamiento',
            'receta',
        ],$atencion->getFillable());
     }
}
