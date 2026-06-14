<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function  index()
    {


        // Récupérattion du nombre  total de membres
        $totalMembres = User::query()->count();

        // Récupérattion des membres avec leurs informations
        $users = User::all();


        return view('membres.index', compact(
            'users',
            'totalMembres'
        ));
    }

    // 1. Afficher le formulaire
    public function create()
    {
        return view('membres.create');
    }

    // 2. Enregistrer les données en Base de Données
    public function store(Request $request)
    {
        // Validation stricte selon ton diagramme de classes
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'num_tel' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:membre,admin',
        ]);

        // Insertion des données
        User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'num_tel' => $validated['num_tel'],
            'adresse' => $validated['adresse'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']), // Cryptage de sécurité exigé
        ]);

        // Redirection vers le tableau avec un message flash de succès
        return redirect()->route('membres.index')->with('success', 'Le membre a été inscrit avec succès au pôle AgroCollab !');
    }

    // 1. Afficher le formulaire de modification
    public function edit(User $membre)
    {

        return view('membres.edit', compact('membre'));
    }

    // 2. Traiter la modification
    public function update(Request $request, User $membre)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $membre->id,
            'num_tel' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'password' => 'nullable|string|min:8', // Optionnel ici
            'role' => 'required|string|in:membre,admin',
        ]);

        $data = [
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'num_tel' => $validated['num_tel'],
            'adresse' => $validated['adresse'],
            'role' => $validated['role'],
        ];

        // On ne change le mot de passe que s'il a été saisi
        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        //$membre->update($data);

        $membre->fill($data)->save();

        return redirect()->route('membres.index')->with('success', 'Les informations du membre ont été mises à jour.');
    }


    // 3. Supprimer un membre
    public function destroy(User $membre)
    {
        //empêcher l'admin connecté de se supprimer lui-même
        if (Auth::id() === $membre->id) {
            return redirect()->route('membres.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte admin.');
        }

        User::destroy($membre->id);

        return redirect()->route('membres.index')->with('success', 'Le membre a été retiré de la coopérative.');
    }
}
