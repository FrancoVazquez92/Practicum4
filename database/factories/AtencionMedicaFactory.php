<?php

namespace Database\Factories;

use App\Models\AtencionMedica;
use App\Models\CitaMedica;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AtencionMedica>
 */
class AtencionMedicaFactory extends Factory
{
    protected $model = AtencionMedica::class;

    public function definition()
    {
        return [
            'cita_medica_id' => \App\Models\CitaMedica::factory(),
            'paciente_nombre' => $this->faker->text,
            'medico_nombre' => $this->faker->text,
            'diagnostico' => $this->faker->text,
            'tratamiento' => $this->faker->text,
            'receta' => $this->faker->text,
        ];
    }
}