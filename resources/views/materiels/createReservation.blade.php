@extends('layouts.app') {{-- Utilise le même design que le reste du site --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-lg">
    
    <div class="mb-6">
        <a href="{{ route('materiels.index') }}" class="text-green-600 hover:text-green-700 font-medium flex items-center space-x-1">
            <span>←</span> <span>Retour à la liste du matériel</span>
        </a>
    </div>

    {{-- FORMULAIRE DE RÉSERVATION --}}
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <div class="flex items-center space-x-2 mb-6">
            <span class="text-2xl">📅</span>
            <h2 class="text-xl font-semibold text-gray-800">Planifier une réservation</h2>
        </div>

        <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- 1. Sélection du Matériel --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Choisir le matériel</label>
                <select name="materiel_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Sélectionner un équipement --</option>
                    @foreach($materiels as $materiel)
                        <option value="{{ $materiel->id }}">{{ $materiel->nom }} ({{ $materiel->etat }})</option>
                    @endforeach
                </select>
            </div>

            {{-- 2. Sélection du Membre (Agriculteur) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Membre de la coopérative</label>
                <select name="user_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Sélectionner l'agriculteur --</option>
                    @foreach($membres as $membre)
                        <option value="{{ $membre->id }}">{{ $membre->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- 3. Dates --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                    <input type="date" name="date_debut" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                    <input type="date" name="date_fin" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
            </div>

            {{-- Bouton de validation --}}
            <button type="submit" class="w-full mt-2 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 shadow">
                Confirmer la réservation
            </button>
        </form>
    </div>

</div>
@endsection