<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleCompra>
 */
class DetalleCompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'compra_id'=>$this->faker->numberBetween(1,100),
            'producto_id'=>$this->faker->numberBetween(1,100),
            'cantidad'=>$this->faker->numberBetween(1,50),
            'precio'=>$this->faker->numberBetween(10,100),
            'impuesto'=>$this->faker->randomElement(['0.15','0.18']),
        ];
    }
}
