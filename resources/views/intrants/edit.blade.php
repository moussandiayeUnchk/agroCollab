@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-lg">
    
    <div class="mb-6">
        <a href="{{ route('intrants.index') }}" class="text-green-600 hover:text-green-700 font-medium flex items-center space-x-1">
            <span>←</span> <span>Retour au stock</span>
        </a>
    </div>

    {{-- BLOC MODIFIER UN STOCK --}}
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-8">
        <div class="flex items-center space-x-2 mb-6">
            <span class="text-2xl">🌱</span>
            <h2 class="text-xl font-semibold text-gray-800">Modifier l'intrant</h2>
        </div>

        <form action="{{ route('intrants.update', $intrant->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom de l'intrant</label>
                <input type="text" name="nom" required value="{{ $intrant->nom }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                <select name="categorie" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="Semences" {{ $intrant->categorie == 'Semences' ? 'selected' : '' }}>Semences</option>
                    <option value="Engrais" {{ $intrant->categorie == 'Engrais' ? 'selected' : '' }}>Engrais</option>
                    <option value="Produits phytos" {{ $intrant->categorie == 'Produits phytos' ? 'selected' : '' }}>Produits phytos</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantité Disponible</label>
                <input type="number" step="0.01" name="quantiteDisponible" required value="{{ $intrant->quantiteDisponible }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 shadow">
                Mettre à jour le stock
            </button>
        </form>
    </div>

    {{-- BLOC SUPPRIMER LE STOCK --}}
    <div class="bg-red-50 p-6 rounded-lg shadow-md border border-red-200">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-red-800">Zone de danger</h3>
            <p class="text-sm text-red-600">Cette action retirera définitivement l'intrant de la coopérative.</p>
        </div>

        <form action="{{ route('intrants.destroy', $intrant->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet intrant ?');">
            @csrf
            @method('DELETE')
            
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 shadow">
                Supprimer cet intrant
            </button>
        </form>
    </div>

</div>
@endsection