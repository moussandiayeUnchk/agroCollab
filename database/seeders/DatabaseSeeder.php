<?php

namespace Database\Seeders;

use App\Models\Intrant;
use App\Models\Materiel;
use App\Models\Recolte;
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
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);  */

        // Création de l'admin
        User::create([
            'nom'=>"admin",
            'prenom'=>"admin",
            'adresse'=>'dakar',
            'email'=>"admin20032@gmail.com",
            'password'=>Hash::make("Azerty2026"), // on crypte le mot de pass 
            'num_tel'=>767940477
        ]);

        // catégorie pour le type de production
        $categories = [
            'Arachide',
            'Riz',
            'Légumes',
            'Maïs',
            'Mil',
            'Sorgho',
            'Tomate',
            'Oignon'
        ];

        // on créé 10 membres fictifs et pour chaque membre générer des récoltes aléatoires
        User::factory(10)->create()->each(function ($user) use ($categories){
            Recolte::factory(rand(2,5))->create([
                'user_id'=>$user->id,
                'quantity'=>fake()->randomFloat(1,0.5,2.5), //poids aléatoire entre 0.5 et 2.5
                'categorieProduction'=>fake()->randomElement($categories)
            ]);
        });


        //créer quelques matériels pour le test
        Materiel::factory(7)->create();


        // création de donnée fictifs pour les intrants
        $categoriesIntrant=[
            'semence', 
            'engrais', 
            'pesticide', 
            'autre'
        ];

        Intrant::factory(10)->create([
            'quantiteDisponible'=>fake()->randomFloat(1,0.5,5.5),
            'categorie'=>fake()->randomElement($categoriesIntrant)
        ]);
        
    }
}
