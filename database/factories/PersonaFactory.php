<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PersonaFactory extends Factory
{
    protected $model = Persona::class;

    public function definition()
    {
        return [
			'dpi' => $this->faker->name,
			'nit' => $this->faker->name,
			'nombres' => $this->faker->name,
			'apellidos' => $this->faker->name,
			'debaja' => $this->faker->name,
        ];
    }
}
