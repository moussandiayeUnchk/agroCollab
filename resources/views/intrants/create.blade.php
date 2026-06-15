<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-gray-600 text-sm">
            <span>AgroCollab</span>
            <span>&gt;</span>
            <a href="{{ route('intrants.index') }}" class="hover:text-emerald-600">Stocks & Intrants</a>
            <span>&gt;</span>
            <span class="text-gray-900 font-medium">Nouvelle entrée de stock</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h2 class="text-2xl font-bold text-gray-950">Enregistrer un nouvel intrant</h2>
                    <p class="text-sm text-gray-500 mt-1">Utilisez ce formulaire uniquement pour référencer un produit qui n'est pas encore présent dans le stock de la coopérative.</p>
                </div>

                <form method="POST" action="{{ route('intrants.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="nom" class="block text-sm font-semibold text-gray-900 mb-2">Nom de l'intrant</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required 
                                placeholder="Ex: Semences Arachide GH119, Urée 46%..."
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                            @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="categorie" class="block text-sm font-semibold text-gray-900 mb-2">Catégorie</label>
                                <select name="categorie" id="categorie" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                    <option value="" disabled selected>Choisir un type...</option>
                                    <option value="Semences" {{ old('categorie') == 'Semences' ? 'selected' : '' }}>Semences</option>
                                    <option value="Engrais" {{ old('categorie') == 'Engrais' ? 'selected' : '' }}>Engrais</option>
                                    <option value="Produits phytos" {{ old('categorie') == 'Produits phytos' ? 'selected' : '' }}>Produits phytosanitaires</option>
                                </select>
                                @error('categorie') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="stock_initial" class="block text-sm font-semibold text-gray-900 mb-2">Quantité initiale (en kg)</label>
                                <input type="number" name="stock_initial" id="stock_initial" value="{{ old('stock_initial') }}" required min="0" step="0.1" placeholder="Ex: 50"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                @error('stock_initial') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end items-center space-x-4 border-t border-gray-100 pt-4 mt-8">
                        <a href="{{ route('intrants.index') }}" class="px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            Annuler
                        </a>
                        <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-[#079669] hover:bg-[#047857] rounded-lg shadow-sm transition-colors">
                            Valider l'entrée
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>