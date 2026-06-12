<?php

namespace Database\Factories;

use App\Models\Materiel;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateDebut = fake()->dateTimeBetween('now', '+1 month');
        // On génère une date de fin située entre 1 et 5 jours après la date de début
        $dateFin = fake()->dateTimeBetween($dateDebut, $dateDebut->format('Y-m-d H:i:s').' +5 days');

        return [
            'user_id' => User::factory(), // Sera écrasé dans le Seeder
            'materiel_id' => Materiel::factory(), // Sera écrasé dans le Seeder
            'date_debut' => $dateDebut->format('Y-m-d'),
            'date_fin' => $dateFin->format('Y-m-d'),
            'statut' => fake()->randomElement(['En cours', 'Terminé', 'Planifié']),
        ];
    }
}
