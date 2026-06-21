<?php

namespace Database\Seeders;

use App\Models\Category; // 🏷️ Ne pas oublier d'importer le modèle Category
use App\Models\Intrant;
use App\Models\Materiel;
use App\Models\Recolte;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Création de l'admin
        User::create([
            'nom' => "admin",
            'prenom' => "admin",
            'adresse' => 'dakar',
            'email' => "admin2026@gmail.com",
            'password' => Hash::make("Azerty2026"), 
            'num_tel' => 767940477,
            'role' => 'admin',
        ]);

        // 2. Création des VRAIES catégories agricoles en base de données
        $categoriesDonnees = [
            'Céréales' => ['Mil', 'Maïs', 'Riz', 'Sorgho'],
            'Oléagineux' => ['Arachide', 'Sésame'],
            'Légumes' => ['Tomate', 'Oignon'],
        ];

        // On insère les catégories et on garde une liste de leurs instances
        $categoriesInstances = [];
        foreach ($categoriesDonnees as $nomCategorie => $produits) {
            $categoriesInstances[] = Category::create(['nom' => $nomCategorie]);
        }

        // 3. Création des 10 membres et de leurs récoltes cohérentes
        $agriculteurs = User::factory(10)->create([
            'role' => 'membre',
            'password' => Hash::make('password')
        ])->each(function ($user) use ($categoriesDonnees, $categoriesInstances) {
            
            // Pour chaque membre, on génère entre 2 et 5 récoltes
            $nombreRecoltes = rand(2, 5);
            for ($i = 0; $i < $nombreRecoltes; $i++) {
                
                // On pioche une catégorie Eloquent au hasard (Céréales, Oléagineux ou Légumes)
                $categorieAleatoire = fake()->randomElement($categoriesInstances);
                
                // On pioche un produit correspondant uniquement à cette catégorie
                $listeProduitsPossibles = $categoriesDonnees[$categorieAleatoire->nom];
                $produitAleatoire = fake()->randomElement($listeProduitsPossibles);

                Recolte::factory()->create([
                    'user_id' => $user->id,
                    'category_id' => $categorieAleatoire->id, 
                    'produit' => $produitAleatoire,
                    'quantity' => fake()->randomFloat(1, 100, 2500), // Augmenté pour faire plus réaliste en Kg pour une coopérative
                    'date_depot' => fake()->dateTimeThisMonth()
                ]);
            }
        });

        // 4. Créer les matériels pour le test
        $materiels = Materiel::factory(3)
             ->sequence(
                ['nom' => 'Tracteur',     'estDisponible' => true],
                ['nom' => 'Motoculteur',  'estDisponible' => false],
                ['nom' => 'Moissonneuse', 'estDisponible' => true],
             )
            ->create();

        // 5. Création de données fictives pour les intrants
        $categoriesIntrant = ['semence', 'engrais', 'pesticide', 'autre'];
        $nomsIntrants = [
            'Semences de maïs hybride',
            'Engrais NPK 15-15-15',
            'Herbicide systémique',
            'Amendement calcaire (Chaux)',
        ];

        Intrant::factory(10)->create([
            'nom' => fake()->randomElement($nomsIntrants),
            'quantiteDisponible' => fake()->randomFloat(1, 0.5, 5.5),
            'categorie' => fake()->randomElement($categoriesIntrant)
        ]);

        // 6. Générer 15 Réservations croisées aléatoirement
        for ($i = 0; $i < 15; $i++) {
            Reservation::factory()->create([
                'user_id' => $agriculteurs->random()->id,
                'materiel_id' => $materiels->random()->id,
            ]);
        }
    }
}