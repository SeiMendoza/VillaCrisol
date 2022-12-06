<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tipo'=>$this->faker->word,
            'proposito' =>$this->faker->randomElement(['consumo','produccion']),
            'descripcion' =>$this->faker->words(10, true),
            'sexo'=>$this->faker->randomElement(['macho', 'hembra']),
            'raza'=>$this->faker->word,
        ];
    }
}
