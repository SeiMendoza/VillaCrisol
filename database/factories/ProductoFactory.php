<?php

namespace Database\Factories;

use App\Models\DetalleCompra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->word,
            'descripcion'=>$this->faker->words(10, true),
            'categoria'=>$this->faker->randomElement(['restaurante','piscina','siembras','animales']),
            'existencia'=>$this->faker->numberBetween(0, 100),
            'precio'=>$this->faker->numberBetween(0, 100),
        ];
    }
}
