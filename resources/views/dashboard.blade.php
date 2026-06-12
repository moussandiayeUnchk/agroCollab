<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Tableau de bord' }}
        </h2>
    </x-slot>

    <h3 class="text-xl font-bold">Vue d'ensemble</h3>

    <!-- infos ou statistiques sur les sur les éléments de la coopértive  -->
    <div class="flex mt-5 justify-evenly ">
        <div
            class="flex flex-col border-b-4 border-b-green-600 justify-center items-center shadow-md w-60 h-40 p-4 rounded-md space-y-2 ">
            <p class="text-3xl font-bold">{{ $totalMembres }}</p>
            <p class="text-xl text-gray-400 font-bold">Membre actifs</p>
        </div>

        <div
            class="flex flex-col border-b-4 border-b-orange-600 justify-center items-center shadow-xl w-60 h-40 p-4 rounded-md space-y-2 ">
            <p class="text-3xl font-bold">{{ $totalRecoltes }} T</p>
            <p class="text-xl text-gray-400 font-bold">Volume de récoltes</p>
        </div>

        <div
            class="flex flex-col border-b-4  border-b-purple-600 justify-center items-center shadow-xl w-60 h-40 p-4 rounded-md space-y-2 ">
            <p class="text-3xl font-bold">{{ $materielsDisponible }} / {{ $totalMateriels }}</p>
            <p class="text-xl text-gray-400 font-bold">Matériels disponibles</p>
        </div>

        <div
            class="flex flex-col border-b-4  border-b-red-600 justify-center items-center shadow-xl w-60 h-40 p-4 rounded-md space-y-2 ">
            <p class="text-3xl font-bold">{{ $alerteStock }}</p>
            <p class="text-xl text-gray-400 font-bold">Alertes stock bas</p>
        </div>

    </div>

    <! -- informations sur les dernières récoltes enregistrés en plus des réservations -->
        <div class="mt-16">
            <p class="font-bold">Dernières récoltes enregistrées</p>
            <p class="text-gray-400">Suivi et validation des déclarations</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 mt-6 space-x-6">
            <!-- affichage des dernières récoltes. -->
            <div class="md:col-span-8">

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 text-sm font-bold text-gray-900 bg-gray-50/50">
                                <th class="py-3 px-4">Date</th>
                                <th class="py-3 px-4">Nom</th>
                                <th class="py-3 px-4">Type de culture</th>
                                <th class="py-3 px-4">Quantité (Kg)</th>
                                <th class="py-3 px-4">Statut</th>
                            </tr>
                        </thead>


                        <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700 ">
                            @forelse ($derniereRecoltes as $recolte)
                                <tr>
                                    <td class="py-4 px-4 text-gray-500">
                                        {{ $recolte->created_at->translatedFormat('j F Y') }}</td>
                                    <td class="py-4 px-4 text-gray-900 font-semibold">{{ $recolte->user->nom }}p</td>
                                    <td class="py-4 px-4">{{ $recolte->categorieProduction }}</td>
                                    <td class="py-4 px-4 font-bold">{{ $recolte->quantity }}</td>
                                    <td class="py-4 px-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Validée</span>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-400">Aucune récolte enregistrée
                                        pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>


            <!-- infos sur les réservations -->
            <div class="md:col-span-4 rounded-xl border-2 border-solid shadow-xl   border-gray-200 ">
                <div class="pb-4 p-4 flex justify-between items-center border-b border-gray-200  ">
                    <p class="font-bold">Réservations Matériel</p>
                    <span class="px-3 py-1 bg-emerald-600 text-white text-md font-bold rounded-lg ">Aujourd'hui</span>
                </div>

                <!-- affichage des 5 dernières réservations efféctuée avec leurs statut -->
                @forelse ($reservations as  $reservation)
                    <div class="flex p-4 items-center justify-between   border-b border-gray-200">
                        <div class="flex flex-col">
                            <p class="font-bold">{{ $reservation->materiel->nom }}</p>
                            <p class="font-bold text-gray-400">{{ $reservation->user->nom }}</p>
                        </div>

                        @if ($reservation->statut === 'En cours')
                            <span
                                class="bg-green-100 font-bold text-emerald-700 text-sm  px-4 py-1.5 h-6 flex items-center text-center rounded-full">
                                En cours
                            </span>
                        @elseif($reservation->statut === 'Terminé')
                            <span
                                class="bg-gray-100 font-bold text-gray-600 text-sm  px-4 py-1.5 h-6 flex items-center text-center rounded-full">
                                Terminé
                            </span>
                        @else
                            <span
                                class="bg-orange-50 font-bold text-orange-600 text-sm  px-4 py-1.5 h-6 flex items-center text-center rounded-full">
                                Planifié
                            </span>
                        @endif
                        
                    </div>

                @empty
                    <div>
                        <p>Pas de Réservation disponible</p>
                    </div>
                @endforelse
                
                <div class="p-4 text-center font-bold text-emerald-600">
                    <a href="">
                            Voir toutes les réservations →
                        </a>
                </div>

            </div>

        </div>

</x-app-layout>
