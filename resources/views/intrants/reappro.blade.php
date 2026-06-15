<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-gray-600 text-sm">
            <span>AgroCollab</span>
            <span>&gt;</span>
            <a href="{{ route('intrants.index') }}" class="hover:text-emerald-600">Stocks & Intrants</a>
            <span>&gt;</span>
            <span class="text-gray-900 font-medium">Réapprovisionnement</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h2 class="text-2xl font-bold text-gray-950">Réapprovisionner un intrant</h2>
                    <p class="text-sm text-gray-500 mt-1">Ajoutez du stock pour un produit existant. La quantité saisie sera cumulée au stock disponible actuel.</p>
                </div>

                <form method="POST" action="{{ route('intrants.reappro.update', $intrant->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg text-sm mb-4">
                        <div>
                            <span class="block text-xs font-semibold text-gray-400 uppercase">Intrant sélectionné</span>
                            <span class="text-base font-bold text-gray-900">{{ $intrant->nom }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-semibold text-gray-400 uppercase">Catégorie</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 mt-1">
                                {{ $intrant->categorie }}
                            </span>
                        </div>
                        <div class="md:col-span-2 pt-2 border-t border-gray-200 mt-2">
                            <span class="text-gray-600">Quantité disponible en ce moment : <strong class="text-gray-900">{{ $intrant->quantiteDisponible }} kg</strong></span>
                        </div>
                    </div>

                    <div>
                        <label for="quantite_ajoutee" class="block text-sm font-semibold text-gray-900 mb-2">Quantité à ajouter (en kg)</label>
                        <div class="relative rounded-md shadow-sm">
                            <input type="number" name="quantite_ajoutee" id="quantite_ajoutee" required min="0.1" step="0.1" autofocus placeholder="Ex: 100"
                                class="w-full rounded-lg border-gray-300 focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        </div>
                        @error('quantite_ajoutee') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end items-center space-x-4 border-t border-gray-100 pt-4 mt-8">
                        <a href="{{ route('intrants.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            Annuler
                        </a>
                        <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-[#079669] hover:bg-[#047857] rounded-lg shadow-sm transition-colors">
                            Augmenter le stock
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>