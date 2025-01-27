<?php

namespace Database\Factories;
use App\Models\Medico;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medico>
 */
class MedicoFactory extends Factory
{
    protected $model = Medico::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence,
            'apellido' => $this->faker->sentence,
            'especialidad' => $this->faker->sentence,
        ];
    }
}
