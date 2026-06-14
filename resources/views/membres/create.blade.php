<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-gray-600 text-sm">
            <span>AgroCollab</span>
            <span>&gt;</span>
            <a href="{{ route('membres.index') }}" class="hover:text-emerald-600">Membres</a>
            <span>&gt;</span>
            <span class="text-gray-900 font-medium">Ajouter un membre</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h2 class="text-2xl font-bold text-gray-950">Inscrire un nouvel agriculteur</h2>
                    <p class="text-sm text-gray-500 mt-1">Remplissez les informations ci-dessous pour créer le compte
                        d'un membre de la coopérative.</p>
                </div>

                <form method="POST" action="{{ route('membres.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="prenom" class="block text-sm font-semibold text-gray-900 mb-2">Prénom</label>
                            <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                            @error('prenom')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nom" class="block text-sm font-semibold text-gray-900 mb-2">Nom</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                            @error('nom')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Adresse
                                Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="num_tel" class="block text-sm font-semibold text-gray-900 mb-2">Numéro de
                                Téléphone</label>
                            <input type="text" name="num_tel" id="num_tel" value="{{ old('num_tel') }}" required
                                placeholder="+221 ..."
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                            @error('num_tel')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="adresse" class="block text-sm font-semibold text-gray-900 mb-2">Adresse /
                                Localité</label>
                            <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}" required
                                placeholder="Ex: Kaolack, Thiaroye..."
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                            @error('adresse')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">Mot de passe
                                initial</label>
                            <div class="relative rounded-lg shadow-sm">
                                <input type="password" name="password" id="password" required placeholder="••••••••"
                                    class="w-full rounded-lg border-gray-300 pr-10 focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">

                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <svg id="eyeOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="eyeClosed" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.9 4.24a9.123 9.123 0 012.1-.24c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.4M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            stroke-dasharray="1 1" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-semibold text-gray-900 mb-2">Rôle
                                système</label>
                            <select name="role" id="role"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                <option value="membre" selected>Membre ordinaire</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end items-center space-x-4 border-t border-gray-100 pt-4 mt-8">
                        <a href="{{ route('membres.index') }}"
                            class="px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-bold text-white bg-[#079669] hover:bg-[#047857] rounded-lg shadow-sm transition-colors">
                            Enregistrer le membre
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            const eyeOpenIcon = document.getElementById('eyeOpen');
            const eyeClosedIcon = document.getElementById('eyeClosed');

            toggleButton.addEventListener('click', function() {
                // Vérifier le type actuel du champ
                const isPassword = passwordInput.getAttribute('type') === 'password';

                // Basculer entre 'password' et 'text'
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                // Alterner l'affichage des icônes
                if (isPassword) {
                    eyeOpenIcon.classList.add('hidden');
                    eyeClosedIcon.classList.remove('hidden');
                } else {
                    eyeOpenIcon.classList.remove('hidden');
                    eyeClosedIcon.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
