<?php

namespace App\Http\Controllers;

use App\Models\Intrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntrantController extends Controller
{ // Afficher la liste des stocks (ton écran actuel)


    public function index()
    {

        // on récupère tous les intrants
        $intrants = Intrant::all();
        return view('intrants.index', compact('intrants'));
    }

    //Afficher le formulaire d'entrée de stock
    public function create()
    {
        return view('intrants.create');
    }

    //Enregistrer le nouvel intrant en Base de Données
    public function store(Request $request)
    {
        // Validation des données entrantes
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string|in:Semences,Engrais,Produits phytos',
            'stock_initial' => 'required|numeric|min:0', // Gère les décimaux grâce à 'numeric'
        ]);

        // Création de l'enregistrement
        Intrant::create([
            'nom' => $validated['nom'],
            'categorie' => $validated['categorie'],
            'stock_initial' => $validated['stock_initial'],

            // C'est le premier jour : le disponible est égal au stock initial
            'quantiteDisponible' => $validated['stock_initial'],
        ]);

        // Redirection vers le tableau des stocks avec un message de succès
        return redirect()->route('intrants.index')->with('success', 'Le nouvel intrant a été enregistré et ajouté au stock !');
    }

    //Afficher le formulaire de réapprovisionnement pré-rempli
    public function editReappro(Intrant $intrant)
    {
        return view('intrants.reappro', compact('intrant'));
    }

    // 2. Traiter l'incrémentation de la quantité disponible
    public function updateReappro(Request $request, Intrant $intrant)
    {
        // On valide uniquement la quantité ajoutée
        $validated = $request->validate([
            'quantite_ajoutee' => 'required|numeric|min:0.1',
        ]);

        // Étape clé : quantité disponible actuelle + nouvelle quantité
        $intrant->quantiteDisponible += $validated['quantite_ajoutee'];

        // Sauvegarde en base de données
        $intrant->save();

        return redirect()->route('intrants.index')
            ->with('success', "Le stock de {$intrant->nom} a été réapprovisionné avec succès !");
    }
/**
     * Afficher le formulaire de modification général d'un intrant.
     */
    public function edit(Intrant $intrant)
    {
        // On renvoie votre vue 'edit.blade.php' en lui passant l'intrant
        return view('intrants.edit', compact('intrant'));
    }

    /**
     * Mettre à jour les informations globales de l'intrant.
     */
    public function update(Request $request, Intrant $intrant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string|in:Semences,Engrais,Produits phytos',
            'quantiteDisponible' => 'required|numeric|min:0',
        ]);

        $intrant->update($validated);

        return redirect()->route('intrants.index')->with('success', 'L\'intrant a été modifié avec succès !');
    }
    public function destroy(Intrant $intrant){
        

        Intrant::destroy($intrant->id);

        return redirect()->route('intrants.index')->with('success', 'Cet intrant a été retiré de la coopérative.');
    }
}
