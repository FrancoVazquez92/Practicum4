<?php

namespace Tests\Unit;

use App\Models\Paciente;
use PHPUnit\Framework\TestCase;

class PacienteTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_creacion_de_un_paciente_en_memoria()
    {
        $paciente = new Paciente(['cedula' => '0302337233','nombre' => 'Franco','apellido' => 'Vazquez','telefono' => '0992672401','direccion' => 'Azogues','correoelectronico' => 'fivazquez@utpl.edu.ec',]);

        $this->assertEquals('0302337233',$paciente->cedula);
        $this->assertEquals('Franco',$paciente->nombre);
        $this->assertEquals('Vazquez',$paciente->apellido);
        $this->assertEquals('0992672401',$paciente->telefono);
        $this->assertEquals('Azogues',$paciente->direccion);
        $this->assertEquals('fivazquez@utpl.edu.ec',$paciente->correoelectronico);
    }

    /**
     * Verficar que los fillable este correctos
     */

     public function test_fillable_Cita(){

        $paciente = new Paciente();
        $this->assertEquals([
            'cedula',
            'nombre',
            'apellido',
            'telefono',
            'direccion',
            'correoelectronico'
        ],$paciente->getFillable());
     }
}
