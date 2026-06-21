<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['produit', 'date_depot', 'quantity', 'user_id', 'category_id'])]
class Recolte extends Model
{
    use HasFactory;

    //Indique à Laravel de traiter automatiquement ce champ comme une vraie Date Carbon
    protected $casts = [
        'date_depot' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
