<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['materiel_id', 'user_id', 'statut', 'date_debut', 'date_fin'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function materiel(){
        return $this->belongsTo(Materiel::class);
    }
}
