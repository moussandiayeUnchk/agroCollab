<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Intrant extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'categorie', 'quantiteDisponible', 'stock_initial'];
}
