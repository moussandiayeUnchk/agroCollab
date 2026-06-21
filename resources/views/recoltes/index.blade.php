<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Récoltes' }}
        </h2>
    </x-slot>
    <div class="flex justify-between">

        <p class="font-bold text-xl">Suivi des Récoltes</p>


        @if (auth()->user()->role === 'admin')
            <div class="bg-emerald-600 font-bold text-white p-1 rounded-md h-8 ">
                <a href="{{ route('recoltes.create') }}">Enregistrer un apport</a>
            </div>
        @endif

    </div>

    @if (session('success'))
        <div id="flash-success"
            class="mb-6 flex items-center p-4 text-emerald-800 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg shadow-sm transition-opacity duration-500">
            <svg class="w-5 h-5 mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>

            <div class="text-sm font-semibold">
                {{ session('success') }}
            </div>
        </div>
    @endif



    <!-- affichage des statistiques des récoltes de la coopérative -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12 mt-8">

        @foreach ($categoriesStats as $cat)
            <div class="bg-white rounded-xl shadow-sm border-b-4 border-emerald-500 p-6 text-center">
                <span class="text-4xl font-extrabold text-gray-900 block mb-1">
                    {{ $cat->recoltes_sum_quantity ?? 0 }}
                </span>
                <span class="text-xs font-medium text-gray-500">Kg de {{ $cat->nom }}</span>
            </div>
        @endforeach

        <div class="bg-white rounded-xl shadow-sm border-b-4 border-red-500 p-6 text-center">
            <span class="text-4xl font-extrabold text-gray-900 block mb-1">{{ $nombreApports }}</span>
            <span class="text-xs font-medium text-gray-500">Apports enregistrés</span>
        </div>
    </div>

    <!-- INFOS SUR LES DERNIERS APPORTS-->
    <table class="w-full text-left border-collapse bg-white text-sm text-gray-500">
    <thead class="bg-gray-50 text-xs font-bold uppercase text-gray-900 border-b border-gray-100">
        <tr>
            <th scope="col" class="px-6 py-4">Membre</th>
            <th scope="col" class="px-6 py-4">Catégorie</th> <th scope="col" class="px-6 py-4">Produit</th>
            <th scope="col" class="px-6 py-4">Quantité</th>
            <th scope="col" class="px-6 py-4">Date Dépôt</th>
             @if (auth()->user()->role === 'admin')
            <th scope="col" class="px-6 py-4 text-center">Actions</th>
            @endif
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100 border-t border-gray-100 font-medium text-gray-900">
        @forelse($recoltes as $recolte)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-gray-900">
                    {{ $recolte->user->prenom }} {{ $recolte->user->nom }}
                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-50 px-2 py-1 text-xs font-semibold text-slate-600 border border-slate-200">
                        {{ $recolte->category->nom ?? 'Non catégorisé' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-700">{{ $recolte->produit }}</td>
                <td class="px-6 py-4 font-bold text-gray-900">{{ $recolte->quantity }} kg</td>
                <td class="px-6 py-4 text-gray-600">
                    {{ $recolte->date_depot->format('d/m/Y') }}
                </td>
                 @if (auth()->user()->role === 'admin')
                <td class="px-6 py-4 text-center space-x-2">
                    <a href="{{ route('recoltes.edit', $recolte->id) }}" class="px-3 py-1.5 bg-[#079669] hover:bg-[#047857] text-white text-xs font-bold rounded shadow-sm transition-colors">
                        Modifier
                    </a>
                    <form action="{{ route('recoltes.destroy', $recolte->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cet apport ?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded shadow-sm transition-colors">
                            Supprimer
                        </button>
                    </form>
                </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                    Aucun apport de récolte enregistré pour le moment.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>


</x-app-layout>
