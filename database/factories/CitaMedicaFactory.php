<?php

namespace Database\Factories;
use App\Models\CitaMedica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaMedicaFactory extends Factory
{
    protected $model = CitaMedica::class;

    public function definition()
    {
        return [
            'paciente_id' => \App\Models\Paciente::factory(),
            'medico_id' => \App\Models\Medico::factory(),
            'fecha' => $this->faker->date,
            'hora' => $this->faker->time,
        ];
    }
}