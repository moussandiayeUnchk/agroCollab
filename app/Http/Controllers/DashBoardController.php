<?php

namespace App\Http\Controllers;

use App\Models\Intrant;
use App\Models\Materiel;
use App\Models\Recolte;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
  
    public function index(){

      // calcul du nombre total de membres
        $totalMembres = User::query()->count();

        // calcul de la somme totale des récoltes
        $totalRecoltes = Recolte::sum('quantity');


        //récupération du nombre total de matériels
        $totalMateriels = Materiel::count();

        // nombre matériels disponible 
        $materielsDisponible= Materiel::where('estDisponible',true)->count();


        // alertes stocks les tocks où la quantité est inférieur à un seuil

        $alerteStock = Intrant::where('quantiteDisponible','<',20)->count();

        // on récuprère les dernières récoltes enregistées avec l'agriculteur associé

        $derniereRecoltes = Recolte::with('user') // on évite le problème du N+1
        ->latest() // du plus récent au plus anciens
        ->take(5) // on prend les 5 derniers
        ->get();

        // on récuprère les réservations
        $reservations = Reservation::with('user','materiel')
        ->latest()
        ->take(4)
        ->get();

        // on récuprère les intrants
        $intrants=Intrant::all();

        return view('dashboard',compact(
          'totalMembres',
          'totalRecoltes',
          'totalMateriels',
          'materielsDisponible',
          'alerteStock',
          'derniereRecoltes',
          'reservations',
          'intrants'
          
        ));


    }
}
