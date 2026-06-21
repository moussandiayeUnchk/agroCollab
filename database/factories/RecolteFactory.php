<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Recolte;
use App\Models\User;
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

        // On récupère une catégorie au hasard parmi celles existantes
        $category = Category::inRandomOrder()->first() ?? Category::create(['nom' => 'Céréales']);

        // Liste de produits cohérents selon la catégorie choisie
        $produitsParCategorie = [
            'Céréales' => ['Mil', 'Maïs', 'Riz', 'Sorgho'],
            'Oléagineux' => ['Arachides', 'Sésame'],
            'Légumineuses' => ['Niébé', 'Voandzou'],
        ];

        // On pioche un produit au hasard dans la bonne liste
        $nomProduit = $this->faker->randomElement($produitsParCategorie[$category->nom] ?? ['Autre']);


        return [
            'produit' => $nomProduit,
            'quantity' => $this->faker->randomFloat(1, 50, 1500), // Poids entre 50.0 et 1500.0 kg
            'date_depot' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'), // Dépôts récents
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(), // Associe à un membre existant ou en crée un
            'category_id' => $category->id,
        ];
    }
}
