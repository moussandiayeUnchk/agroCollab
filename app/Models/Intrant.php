<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nom','categorie','quantiteDisponible','stock_initial'])]
class Intrant extends Model
{
    use HasFactory;
    //
}
