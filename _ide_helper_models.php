<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property string $categorie
 * @property numeric $stock_initial
 * @property numeric $quantiteDisponible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\IntrantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant whereCategorie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant whereQuantiteDisponible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant whereStockInitial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intrant whereUpdatedAt($value)
 */
	class Intrant extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property int $estDisponible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\MaterielFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Materiel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Materiel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Materiel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Materiel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Materiel whereEstDisponible($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Materiel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Materiel whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Materiel whereUpdatedAt($value)
 */
	class Materiel extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $categorieProduction
 * @property numeric $quantity
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\RecolteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recolte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recolte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recolte query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recolte whereCategorieProduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recolte whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recolte whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recolte whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recolte whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recolte whereUserId($value)
 */
	class Recolte extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $date_debut
 * @property string $date_fin
 * @property int $user_id
 * @property int $materiel_id
 * @property string $statut
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Materiel $materiel
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ReservationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereDateDebut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereDateFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereMaterielId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUserId($value)
 */
	class Reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $adresse
 * @property int $num_tel
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Recolte> $recoltes
 * @property-read int|null $recoltes_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNumTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

