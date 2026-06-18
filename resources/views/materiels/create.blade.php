<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-gray-600 text-sm">
            <span>AgroCollab</span>
            <span>&gt;</span>
            <a href="{{ route('materiels.index') }}" class="hover:text-emerald-600">Catalogue Matériels</a>
            <span>&gt;</span>
            <span class="text-gray-900 font-medium">Nouveau matériel</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h2 class="text-2xl font-bold text-gray-950">Ajouter un matériel</h2>
                    <p class="text-sm text-gray-500 mt-1">Enregistrez un nouvel équipement ou engin agricole disponible pour les membres de la coopérative.</p>
                </div>

                <form method="POST" action="{{ route('materiels.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="nom" class="block text-sm font-semibold text-gray-900 mb-2">Nom du matériel</label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required 
                            placeholder="Ex: Tracteur John Deere, Motopompe Diesel, Batteuse à Mil..."
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="bg-emerald-50 text-emerald-800 rounded-lg p-4 text-xs font-medium flex items-start">
                        <svg class="w-4 h-4 mr-2.5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Note : À la création, ce matériel sera automatiquement configuré avec le statut <strong class="underline">Disponible</strong> et visible pour les réservations.</span>
                    </div>

                    <div class="flex justify-end items-center space-x-4 border-t border-gray-100 pt-4 mt-6">
                        <a href="{{ route('materiels.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            Annuler
                        </a>
                        <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-[#079669] hover:bg-[#047857] rounded-lg shadow-sm transition-colors">
                            Ajouter le matériel
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>