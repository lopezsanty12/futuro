<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpresaFactory extends Factory
{
    protected $model = Empresa::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'persona' => $this->faker->name,
			'debaja' => $this->faker->name,
        ];
    }
}
