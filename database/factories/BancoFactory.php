<?php

namespace Database\Factories;

use App\Models\Banco;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BancoFactory extends Factory
{
    protected $model = Banco::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'debaja' => $this->faker->name,
        ];
    }
}
