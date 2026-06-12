<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['materiel_id','user_id','statut','date_debut','date_fin'])]
class Reservation extends Model
{
    use HasFactory;
    //relation vers le user
    public function user(){
        return $this->belongsTo(User::class);
    }

       //relation vers le materiel

       public function materiel(){
        return $this->belongsTo(Materiel::class);
       }
}
