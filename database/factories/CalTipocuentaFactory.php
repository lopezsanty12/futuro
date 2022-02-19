<?php

namespace Database\Factories;

use App\Models\CalTipocuenta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CalTipocuentaFactory extends Factory
{
    protected $model = CalTipocuenta::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'debaja' => $this->faker->name,
        ];
    }
}
