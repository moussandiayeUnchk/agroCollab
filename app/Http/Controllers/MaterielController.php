<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterielController extends Controller
{
    /**
     * Afficher le catalogue et l'historique des réservations
     */
    public function index()
    {
        // 1. Récupérer tous les matériels pour le catalogue du haut (cartes)
        $materiels = Materiel::all();

        // 2. Récupérer toutes les réservations triées par date récente pour le tableau du bas
        // On récupère les lignes de la table pivot avec les infos du matériel et du membre
        $reservations = DB::table('reservations')
            ->join('materiels', 'reservations.materiel_id', '=', 'materiels.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->select(
                'reservations.id as reservation_id',
                'reservations.date_debut',
                'reservations.date_fin',
                'reservations.statut',
                'materiels.nom as materiel_nom',
                'users.prenom as user_prenom',
                'users.nom as user_nom'
            )
            ->orderBy('reservations.created_at', 'desc')
            ->get();

            // VÉRIFICATION AUTOMATIQUE : Libérer les matériels dont le temps est écoulé

            $reservationsTerminees=DB::table('reservations')
            ->where('statut','En cours')
            ->where('date_fin','<=',now())
            ->get();

            foreach($reservationsTerminees as $res){
                //On passe la réservation à "Terminée"
                DB::table('reservations')->where('id',$res->id)->update(['statut'=>"Terminé"]);

                //On passe le statut du matériel à "Disponible"
                DB::table('materiels')->where('id',$res->materiel_id)->update(['estDisponible'=>true]);
            }

        return view('materiels.index', compact('materiels', 'reservations'));
    }

    /**
     * 1. Afficher le formulaire de création d'un matériel
     */
    public function create()
    {
        return view('materiels.create');
    }

    /**
     * 2. Enregistrer le nouveau matériel en base de données
     */
    public function store(Request $request)
    {
        // Validation simple du nom
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:materiels,nom',
        ]);

        // Création (disponible par défaut grâce à la migration)
        Materiel::create([
            'nom' => $validated['nom'],
            'est_disponible' => true
        ]);

        return redirect()->route('materiels.index')
            ->with('success', 'Le nouveau matériel a été ajouté au catalogue d\'AgroCollab avec succès !');
    }


    /**
     * Afficher le formulaire de réservation pour un matériel précis
     */
    public function createReservation(Materiel $materiel)
    {
        // Sécurité : si le matériel est déjà pris, on bloque l'accès au formulaire
        if (!$materiel->estDisponible) {
            return redirect()->route('materiels.index')->with('error', 'Ce matériel n\'est pas disponible pour le moment.');
        }

        return view('materiels.reserver', compact('materiel'));
    }


    /**
     * Enregistrer la réservation et basculer le statut du matériel
     */
    public function storeReservation(Request $request, Materiel $materiel)
    {
        //Validation des dates (on donne une marge de 5 minutes dans le passé pour éviter le piège des secondes)
        /*   
        Si on avait laissé la règle after_or_equal: now , Laravel comparerait : 
        la date saisie : 14h30min 00s L'heure du serveur ( now ) : 14h30min 45s
        Verdict: 14h30:00 est dans le passé par rapport à 14h30:45 X Échec de la validation.

        Avec $dateMinimum = now()-›subMinutes (5) , on dit au serveur : "Calcule l'heure qu'il était il y a 5 minutes".
        L'heure du serveur au clic : 14h30 et 45 secondes et Le $dateMinimum (5 minutes en arrière) : 14h25 et 45 secondes
        Maintenant, Laravel fait sa comparaison after_or_equal: la date saisie : 14h30min 00s
        La date minimale acceptée : 14h25min 45s
        Verdict : 14h30 est bien situé après 14h25 ! Validation réussie, la réservation est enregistrée.
        En résumé, on élargit la zone de tolérance en acceptant que la date saisie puisse dater d'il y a
        quelques minutes, ce qui compense le temps humain de remplissage du formulaire et le décalage des secondes.
        */
        $dateMinimum = now()->subMinutes(5)->toDateTimeString();


        //validation des dates
        $validated = $request->validate([
            'date_debut' => 'required|date|after_or_equal:now' . $dateMinimum,
            'date_fin' => 'required|date|after:date_debut',
        ]);

        // Sécurité : Vérifier si le matériel n'a pas été pris entre-temps
        if (!$materiel->estDisponible) {
            return redirect()->route('materiels.index')->with('error', 'Désolé, ce matériel vient tout juste d\'être réservé !');
        }

        // 2. Création de la ligne dans la table pivot 'reservations'
        // On utilise l'ID de l'utilisateur actuellement connecté au système
        $materiel->users()->attach(Auth::id(), [
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'statut' => "En cours"
        ]);


       // 3. Changement d'état du matériel en base de données
        $materiel->estDisponible = false;
        $materiel->save();

        return redirect()->route('materiels.index')
            ->with('success', "Le matériel {$materiel->nom} a été réservé avec succès et est maintenant en cours d'utilisation.");
    }

    /**
 * Forcer la fin d'un emprunt (Retour anticipé)
 */
public function terminerReservation($id)
{
    $reservation = DB::table('reservations')->where('id', $id)->first();

    if ($reservation) {
        // 1. Mettre à jour la table pivot
        DB::table('reservations')->where('id', $id)->update([
            'statut' => 'Terminée',
            'date_fin' => now()
        ]);

        // 2. Libérer le matériel proprement via l'instance 
        $materiel = Materiel::find($reservation->materiel_id);
        if ($materiel) {
            $materiel->estDisponible = true;
            $materiel->save();
        }

        return redirect()->route('materiels.index')
            ->with('success', 'Le matériel a été restitué avec succès et est de nouveau disponible.');
    }

    return redirect()->route('materiels.index')->with('error', 'Réservation introuvable.');
}
}
