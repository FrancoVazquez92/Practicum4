<?php

namespace Database\Factories;
use App\Models\Paciente;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cedula' => $this->faker->sentence,
            'nombre' => $this->faker->sentence,
            'apellido' => $this->faker->sentence,
            'telefono' => $this->faker->sentence,
            'direccion' => $this->faker->sentence,
            'correoelectronico' => $this->faker->sentence,
        ];
    }
    
}

