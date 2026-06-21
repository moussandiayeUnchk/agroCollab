<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Stocks' }}
        </h2>
    </x-slot>
    <div class="flex justify-between">
        <div class=" flex flex-col space-y-2">
            <p class="font-bold text-xl">Stocks & Intrants</p>
            <p class="font-bold text-gray-500">Semences, enhgrais et produits phytosanitaires</p>
        </div>
        @if (auth()->user()->role === 'admin')
            <div class="bg-emerald-600 font-bold text-white p-1 rounded-md h-8 ">
                <a href="{{ route('intrants.create') }}">+ Entrée de stock</a>
            </div>
        @endif
    </div>

    @if (session('success'))
        <div id="flash-success"
            class="mb-6 flex items-center p-4 text-emerald-800 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg shadow-sm transition-opacity duration-500">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>

            <div class="text-sm font-semibold">
                {{ session('success') }}
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const alertBox = document.getElementById('flash-success');
                if (alertBox) {
                    setTimeout(() => {
                        // 1. On lance une transition d'opacité pour l'effet fluide
                        alertBox.style.opacity = '0';

                        // 2. On retire complètement l'élément du DOM après la fin de l'animation (500ms)
                        setTimeout(() => {
                            alertBox.remove();
                        }, 500);
                    }, 4000); // 4000 millisecondes = 4 secondes de visibilité
                }
            });
        </script>
    @endif

    <!-- affichage des Intrants -->
    <div class="overflow-x-auto rounded-lg border border-gray-100 mt-8">
        <table class="w-full text-left border-collapse bg-white text-sm text-gray-500">
            <thead class="bg-gray-50 text-xs font-bold uppercase text-gray-900 border-b border-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-4">Intrant</th>
                    <th scope="col" class="px-6 py-4">Catégorie</th>
                    <th scope="col" class="px-6 py-4">Quantité</th>
                    @if (auth()->user()->role === 'admin')
                        <th scope="col" class="px-6 py-4 text-right">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100 font-medium text-gray-900">

                @forelse ($intrants as $intrant)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-bold text-gray-900">
                            {{ $intrant->nom }}
                        </td>

                        <td class="px-6 py-4">
                            @if ($intrant->categorie === 'Semences')
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                    Semences
                                </span>
                            @elseif($intrant->categorie === 'Engrais')
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-2.5 py-1 text-xs font-semibold text-orange-700">
                                    Engrais
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                    {{ $intrant->categorie }}
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ number_format($intrant->quantiteDisponible, 1) }} kg
                        </td>

                        <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                            @if (auth()->user()->role === 'admin')
                                {{-- Actions visibles uniquement pour l'admin --}}
                                <a href="{{ route('intrants.reappro.form', $intrant->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-[#079669] hover:bg-[#047857] text-white text-xs font-bold rounded-md transition-colors shadow-sm">
                                    Réappro.
                                </a>

                                <form action="{{ route('intrants.destroy', $intrant->id) }}" method="POST"
                                    class="form-delete-intrant inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmerSuppressionIntrant(this)"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-md transition-colors shadow-sm">
                                        Supprimer
                                    </button>
                                </form>
                            @else
                                {{-- Version désactivée ou discrète pour les simples membres --}}
                                <span
                                    class="inline-flex items-center px-2.5 py-1.5 bg-gray-100 text-gray-400 text-xs font-semibold rounded-md cursor-not-allowed opacity-60 border border-gray-200 select-none">
                                    🔒 Actions restreintes
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            Aucun intrant enregistré pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    </div>
    </div>
    </div>

    <script>
        function confirmerSuppressionIntrant(button) {
            const form = button.closest('.form-delete-intrant');
            if (confirm(
                    "⚠️ Souhaitez-vous retirer définitivement cet intrant des stocks ?\n\nCette action est irréversible."
                )) {
                form.submit();
            }
        }
    </script>
</x-app-layout>
