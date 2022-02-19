<?php

namespace Database\Factories;

use App\Models\CalCuenta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CalCuentaFactory extends Factory
{
    protected $model = CalCuenta::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'tipocuentas' => $this->faker->name,
			'minimo' => $this->faker->name,
			'debaja' => $this->faker->name,
        ];
    }
}
