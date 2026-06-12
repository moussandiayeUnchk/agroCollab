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
        // On définit d'abord un stock de départ 
        $stockInitial = fake()->randomElement([100, 200, 300, 500]);


        $categoriesIntrant=[
            'semence', 
            'engrais', 
            'pesticide', 
            'autre'
        ];
        return [
            'categorie'=>fake()->randomElement($categoriesIntrant),
            'stock_initial' => $stockInitial,
            // La quantité disponible sera un nombre aléatoire entre 10kg et le stock initial maximum
            'quantiteDisponible'=>fake()->numberBetween(10,$stockInitial),
        ];
    }
}
