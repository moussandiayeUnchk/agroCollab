<?php

namespace Database\Factories;

use App\Models\Intrant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Intrant>
 */
class IntrantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoriesIntrant=[
            'semence', 
            'engrais', 
            'pesticide', 
            'autre'
        ];
        return [
            'categorie'=>fake()->randomElement($categoriesIntrant),
            'quantiteDisponible'=>fake()->randomFloat(1,0.5,5.5),
        ];
    }
}
