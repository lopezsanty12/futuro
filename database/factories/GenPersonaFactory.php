<?php

namespace Database\Factories;

use App\Models\GenPersona;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GenPersonaFactory extends Factory
{
    protected $model = GenPersona::class;

    public function definition()
    {
        return [
			'dpi' => $this->faker->name,
			'nit' => $this->faker->name,
			'nombres' => $this->faker->name,
			'apellidos' => $this->faker->name,
			'id_cuenta' => $this->faker->name,
			'debaja' => $this->faker->name,
        ];
    }
}
