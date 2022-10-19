<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombreCompleto'=>$this->faker->name,
            'numeroId'=>$this->faker->numberBetween(0,9).$this->faker->numerify('###-')
            .$this->faker->numberbetween(1950, 2005)
            .$this->faker->unique()->numerify('-#####'),
            'correo'=> $this->faker->unique()->safeEmail(),
            'numeroTelefono'=>$this->faker->randomElement(['3','8','9']).$this->faker->numerify('###-####'),
            'domicilio'=>$this->faker->city,
        ];
    }
}
