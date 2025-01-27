<?php

namespace Tests\Unit;

use App\Models\CitaMedica;
use PHPUnit\Framework\TestCase;

class CitaMedicaRelationshipTest extends TestCase
{
    public function test_cita_medica_tiene_relacion_con_paciente(){

        $cita = new CitaMedica();
    
    
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $cita->paciente());
    
    
    
    }
}
