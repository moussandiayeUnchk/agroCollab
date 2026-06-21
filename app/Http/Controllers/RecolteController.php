<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recolte;
use App\Models\User;
use Illuminate\Http\Request;

class RecolteController extends Controller
{
    public function index(){
       
        // Récupère TOUTES les catégories et calcule dynamiquement la somme de la colonne 'quantity' de leurs 'recoltes'
    // Laravel va créer automatiquement un attribut nommé 'recoltes_sum_quantity' sur chaque catégorie !
    $categoriesStats = Category::withSum('recoltes', 'quantity')->get();

    //Le nombre total d'apports (toutes catégories confondues)
    $nombreApports = Recolte::count();

    //L'historique pour le tableau du bas
    $recoltes = Recolte::with(['user', 'category'])
        ->orderBy('date_depot', 'desc')
        ->get();

    return view('recoltes.index', compact('categoriesStats', 'nombreApports', 'recoltes'));
    }

    //Formulaire de création
    public function create()
    {  
        $categories = Category::all();
        $membres = User::where('role', 'membre')->get(); // Pour choisir quel membre fait l'apport
        return view('recoltes.create', compact('categories', 'membres'));
    }


    //Sauvegarde de l'apport
    public function store(Request $request)
    {
     $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'produit' => 'required|string|max:255',
        'quantity' => 'required|numeric|min:0.1',
        'date_depot' => 'required|date',
        'user_id' => 'required|exists:users,id',
    ]);

    Recolte::create($validated);

    return redirect()->route('recoltes.index')->with('success', 'Apport enregistré avec succès.');
}


 //Formulaire de modification
    public function edit($id)
{
    $recolte = Recolte::findOrFail($id);
    $categories = Category::all();
    $membres = User::where('role', 'membre')->get();
    return view('recoltes.edit', compact('recolte', 'categories', 'membres'));
}


 //Mise à jour de l'apport
public function update(Request $request, $id)
{
    $recolte = Recolte::findOrFail($id);

    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'produit' => 'required|string|max:255',
        'quantity' => 'required|numeric|min:0.1',
        'date_depot' => 'required|date',
        'user_id' => 'required|exists:users,id',
    ]);

    $recolte->update($validated);

    return redirect()->route('recoltes.index')->with('success', 'Apport mis à jour avec succès.');
}


    //Suppression de l'apport
    public function destroy($id)
    {
        $recolte = Recolte::findOrFail($id);
        $recolte->delete();

        return redirect()->route('recoltes.index')->with('success', 'L\'apport a été supprimé.');
    }
}
