<?php

namespace Database\Factories;

use App\Models\Recolte;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recolte>
 */
class RecolteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'quantity' => fake()->randomFloat(1, 0.5, 2.5),

            'categorieProduction' => fake()->randomElement([

                'Arachide',

                'Riz',

                'Légumes',

                'Maïs',

                'Mil',

                'Sorgho',

            ]),

        ];
    }
}
