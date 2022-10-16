<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numeroFactura'=>$this->faker->unique()->numerify('#########'),
            'nombreCompra'=>$this->faker->word(),
            'fecha'=>$this->faker->date(),
            'cantidad'=>$this->faker->numberBetween(0,1000),
            'precio'=>$this->faker->randomFloat($nbMaxDecimal = 2, $min=0, $max= null),
            'total'=>$this->faker->randomFloat($nbMaxDecimal = 2, $min=0, $max= null),
            'observacion'=>$this->faker->sentence(),
            'imagenFactura'=>$this->faker->image(),
            'fechaRegistro'=>$this->faker->date(),
            'usuario'=>$this->faker->name()
        ];
    }
}
