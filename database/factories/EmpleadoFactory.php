<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'NombreCompleto'=>$this->faker->name,
            'NúmeroDeIdentidad'=>$this->faker->numberBetween(0,1).$this->faker->numerify('###-')
            .$this->faker->numberbetween(1950, 2005)
            .$this->faker->unique()->numerify('-#####'),
            'CorreoElectrónico'=> $this->faker->unique()->safeEmail(),
            'NúmeroTelefónico'=>$this->faker->randomElement(['2','3','8','9']).$this->faker->numerify('#######'),
            'NúmeroDeReferencia'=>$this->faker->randomElement(['2','3','8','9']).$this->faker->numerify('#######'), 
            'NombreDeLaReferencia'=>$this->faker->name,
            'Domicilio'=>$this->faker->city,
            'FechaDeIngreso'=>$this->faker->dateTimeBetween('-40 years', '-16 years'),
            'Estado'=>$this->faker->randomElement(['temporal','permanente'])
        ];
    }
}
