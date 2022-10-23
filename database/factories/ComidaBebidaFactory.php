<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ComidaBebidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
             'Nombre'=>$this->faker->name,
             'Descripción'=>$this->faker->word,
             'Tipo'=>$this->faker->randomElement(['Bebida','plato','combo']),
             'Precio'=>$this->faker->numberBetween(50,200),
             'Tamaño'=>$this->faker->randomElement(['personal','2 personas','familiar']),
             'Imagen'=>$this->faker->imageUrl(),
             'Activo'=>$this->faker->randomElement(['si','no']),
        ];
    }
}
