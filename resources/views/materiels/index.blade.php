<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Matériels' }}
        </h2>
    </x-slot>
    <div class="flex justify-between">

        <p class="font-bold text-xl">Catalogue Matériels</p>


        @if (auth()->user()->role === 'admin')
            <div class="bg-emerald-600 font-bold text-white p-1 rounded-md h-8 ">
                <a href="{{ route('materiels.create') }}">Ajouter un matériel</a>
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
    @endif



    <!-- affichage de la liste des matériels -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 mt-8">
        @forelse ($materiels as $materiel)
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-between text-center min-h-[220px]">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $materiel->nom }}</h3>

                    @if ($materiel->estDisponible)
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
                            Disponible
                        </span>
                    @else
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-600">
                            Indisponible
                        </span>
                    @endif
                </div>

                <div class="w-full mt-6">
                    @if ($materiel->estDisponible)
                        <a href="{{ route('materiels.reserver.form', $materiel->id) }}"
                            class="block w-full py-2.5 text-center text-sm font-bold text-white bg-[#079669] hover:bg-[#047857] rounded-lg transition-colors shadow-sm">
                            Réserver
                        </a>
                    @else
                        <button disabled
                            class="w-full py-2.5 text-center text-sm font-bold text-gray-400 bg-gray-200 rounded-lg cursor-not-allowed">
                            Réserver
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div
                class="md:col-span-3 bg-white p-8 text-center rounded-xl text-gray-400 shadow-sm border border-gray-100">
                Aucun matériel disponible dans le catalogue pour le moment.
            </div>
        @endforelse
    </div>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-900">Toutes les réservations</h2>
            <p class="text-sm text-gray-500">Suivi des demandes d'emprunt d'équipements</p>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-100">
            <table class="w-full text-left border-collapse bg-white text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs font-bold uppercase text-gray-900 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-4">Matériel</th>
                        <th scope="col" class="px-6 py-4">Membre</th>
                        <th scope="col" class="px-6 py-4">Date Début</th>
                        <th scope="col" class="px-6 py-4">Date Fin</th>
                        <th scope="col" class="px-6 py-4">Statut</th>
                        @if (auth()->user()->role === 'admin')
                        <th scope="col" class="px-6 py-4 text-right">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100 font-medium text-gray-900">
                    @forelse ($reservations as $res)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $res->materiel_nom }}</td>

                            <td class="px-6 py-4 text-gray-700">{{ $res->user_prenom }} {{ $res->user_nom }}</td>

                            <td class="px-6 py-4 text-gray-600">
                                <!-- Permet de transformer la chaîne de date SQL brute en un objet Carbon directement dans Blade pour utiliser
                                translatedFormat('d/m H\hi'). Cela affichera exactement la date sous la forme condensée et lisible
                                (ex: 02/06 12h00)
.  -->
                                {{ \Carbon\Carbon::parse($res->date_debut)->translatedFormat('d/m H\hi') }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                <!-- Permet de transformer la chaîne de date SQL brute en un objet Carbon directement dans Blade pour utiliser
                                translatedFormat('d/m H\hi'). Cela affichera exactement la date sous la forme condensée et lisible
                                (ex: 02/06 12h00).  -->
                                {{ \Carbon\Carbon::parse($res->date_fin)->translatedFormat('d/m H\hi') }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($res->statut === 'En cours')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
                                        En cours
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">
                                        {{ $res->statut }}
                                    </span>
                                @endif
                            </td>

                           @if (auth()->user()->role === 'admin')
                            <td class="px-6 py-4 text-right">
                                @if ($res->statut === 'En cours')
                                    <form action="{{ route('reservations.terminer', $res->reservation_id) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Confirmer le retour de ce matériel ?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold rounded shadow-sm transition-colors">
                                            Rendre le matériel
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 italic">Aucune action</span>
                                @endif
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                                Aucune réservation enregistrée dans l'historique.
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
</x-app-layout>
