<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RcompraProducto>
 */
class RcompraProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'numfactura'=>$this->faker->unique()->numerify('#####'), 
            'proveedor'=>$this->faker->name(),
            'descripción'=>$this->faker->text(), 
            'categoria'=>$this->faker->randomElement(['Restaurante','Piscina','Siembra','Animales']) ,
            'fecha'=>$this->faker->dateTimeBetween('-2 years', '-1 years'),
            'total'=>$this->faker->randomFloat(2,100,500)
        ];
    }
}
