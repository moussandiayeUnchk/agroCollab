<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiel; 
use App\Models\User;     

class ReservationController extends Controller
{
    /**
     * Afficher le formulaire de réservation.
     */
    public function create()
    {
        // On récupère tous les matériels et tous les membres de la coopérative
        $materiels = Materiel::all();
        $membres = User::all(); 

        // On renvoie la vue que vous venez de remplir sur GitHub !
        return view('materiels.createReservation', compact('materiels', 'membres'));
    }

    /**
     * Enregistrer la réservation dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation stricte des champs du formulaire
        $request->validate([
            'materiel_id' => 'required',
            'user_id' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        // Ici, le code pour enregistrer en base de données dépendra de la structure finale 
        // de la table choisie par votre équipe. En attendant, on gère la redirection propre :
        return redirect()->route('materiels.index')->with('success', 'La réservation a été planifiée avec succès !');
    }
}