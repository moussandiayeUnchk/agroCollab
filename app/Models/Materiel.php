<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Materiel extends Model
{
    use HasFactory;
    protected $fillable = ['estDisponible', 'nom'];
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
    public function users(){
        return $this->belongsToMany(User::class, 'reservations')
            ->withPivot('id', 'date_debut', 'date_fin', 'statut')
            ->withTimestamps();
    }
}
