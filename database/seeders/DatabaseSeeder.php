<?php

namespace Database\Seeders;

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


        // création de user normal
          User::create([
            'nom'=>"user1",
            'prenom'=>"user1",
            'adresse'=>'dakar',
            'email'=>"user1@gmail.com",
            'password'=>Hash::make("Passer123"), // on crypte le mot de pass 
            'num_tel'=>775503860
        ]);


        
    }
}
