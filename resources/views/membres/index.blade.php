<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Membres' }}
        </h2>
    </x-slot>
    <div class="flex justify-between">
        <div class=" flex flex-col space-y-3">
            <p class="font-bold text-xl">Gestion des Membres</p>
            <span class="bg-emerald-600 font-bold text-white  rounded-full flex justify-center w-30 py-1 ">
                Tous ( {{ $totalMembres }} )
            </span>
        </div>
        @if (auth()->user()->role === 'admin')
            <div class="bg-emerald-600 font-bold text-white p-1 rounded-md h-8 ">
                <a href="{{ route('membres.create') }}">Ajouter un membre</a>
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



    <!-- affichage de la liste des Membres -->
    <table class="w-full text-left border-collapse mt-14">
        <thead>
            <tr class="border-b border-gray-200 text-sm font-bold text-gray-900 bg-gray-50/50">
                <th class="py-3 px-4">Membre</th>
                <th class="py-3 px-4">Contact</th>
                <th class="py-3 px-4">Adresse</th>

                @if (auth()->user()->role === 'admin')
                    <th class="py-3 px-4">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700">
            @foreach ($users as $user)
                <tr>
                    <td class="py-4 px-4 text-gray-900 font-semibold">
                        {{ $user->prenom }} {{ $user->nom }}
                    </td>

                    <td class="py-4 px-4 text-gray-600">
                        <div class="flex flex-col">
                            <span>{{ $user->email }}</span>
                            <span class="text-xs text-gray-400 mt-0.5">{{ $user->num_tel }}</span>
                        </div>
                    </td>

                    <td class="py-4 px-4 text-gray-500">
                        {{ $user->adresse ?? 'Non spécifiée' }}
                    </td>

                    @if (auth()->user()->role === 'admin')
                        <td class="py-4 px-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('membres.edit', $user->id) }}"
                                    class="px-3 py-1 bg-emerald-600 text-white text-xs font-bold rounded hover:bg-emerald-700 transition-colors">
                                    Modifier
                                </a>
                                <form action="{{ route('membres.destroy', $user->id) }}" method="POST"
                                    class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmerSuppression(this)"
                                        class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded hover:bg-red-700 transition-colors">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        function confirmerSuppression(button) {
            // Sélectionner le formulaire parent du bouton cliqué
            const form = button.closest('.form-delete');

            // Utilisation d'une boîte de dialogue native mais propre
            // (Tu pourras remplacer par un modal Tailwind si tu veux le styliser à 100%)
            if (confirm(
                    "⚠️ ATTENTION : Êtes-vous sûr de vouloir supprimer définitivement ce membre ?\n\nCette action est irréversible et annulera ses accès à AgroCollab."
                    )) {
                form.submit();
            }
        }
    </script>
</x-app-layout>
