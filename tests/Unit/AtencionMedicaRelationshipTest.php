<?php

namespace Tests\Unit;

use App\Models\AtencionMedica;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class AtencionMedicaRelationshipTest extends TestCase
{

    public function test_atencion_medica_tiene_relacion_con_cita_medica(){

    $atencion = new AtencionMedica();


    $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $atencion->CitaMedica());



    }
}
