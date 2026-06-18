<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-gray-600 text-sm">
            <span>AgroCollab</span>
            <span>&gt;</span>
            <a href="{{ route('materiels.index') }}" class="hover:text-emerald-600">Matériels</a>
            <span>&gt;</span>
            <span class="text-gray-900 font-medium">Réserver {{ $materiel->nom }}</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 border-b border-gray-100 pb-3">
                    <h2 class="text-xl font-bold text-gray-900">Planifier l'emprunt</h2>
                    <p class="text-sm text-gray-500">Matériel : <strong class="text-emerald-700">{{ $materiel->nom }}</strong></p>
                </div>

                <form method="POST" action="{{ route('materiels.reserver.store', $materiel->id) }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="date_debut" class="block text-sm font-semibold text-gray-700 mb-1">Date et heure de début</label>
                        <input type="datetime-local" name="date_debut" id="date_debut" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        @error('date_debut') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="date_fin" class="block text-sm font-semibold text-gray-700 mb-1">Date et heure de fin prévue</label>
                        <input type="datetime-local" name="date_fin" id="date_fin" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        @error('date_fin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100 mt-6">
                        <a href="{{ route('materiels.index') }}" class="px-4 py-2 text-sm font-bold text-gray-700 hover:bg-gray-100 rounded-lg">
                            Annuler
                        </a>
                        <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-[#079669] hover:bg-[#047857] rounded-lg shadow-sm">
                            Confirmer l'emprunt
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>