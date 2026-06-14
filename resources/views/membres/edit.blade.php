<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-gray-600 text-sm">
            <span>AgroCollab</span>
            <span>&gt;</span>
            <a href="{{ route('membres.index') }}" class="hover:text-emerald-600">Membres</a>
            <span>&gt;</span>
            <span class="text-gray-900 font-medium">Modifier le membre</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h2 class="text-2xl font-bold text-gray-950">Modifier le profil de {{ $membre->name }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Modifiez les champs nécessaires. Laissez le mot de passe vide
                        si vous ne souhaitez pas le changer.</p>
                </div>
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                        <strong>Attention !</strong> Veuillez vérifier les erreurs ci-dessous :
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('membres.update', $membre) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="prenom" class="block text-sm font-semibold text-gray-900 mb-2">Prénom</label>
                            <input type="text" name="prenom" id="prenom"
                                value="{{ old('prenom', $membre->prenom) }}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring-emerald-200">
                        </div>

                        <div>
                            <label for="nom" class="block text-sm font-semibold text-gray-900 mb-2">Nom</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $membre->nom) }}"
                                required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring-emerald-200">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Adresse
                                Email</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $membre->email) }}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring-emerald-200">
                        </div>

                        <div>
                            <label for="num_tel" class="block text-sm font-semibold text-gray-900 mb-2">Numéro de
                                Téléphone</label>
                            <input type="text" name="num_tel" id="num_tel"
                                value="{{ old('num_tel', $membre->num_tel) }}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring-emerald-200">
                        </div>

                        <div class="md:col-span-2">
                            <label for="adresse" class="block text-sm font-semibold text-gray-900 mb-2">Adresse /
                                Localité</label>
                            <input type="text" name="adresse" id="adresse"
                                value="{{ old('adresse', $membre->adresse) }}" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring-emerald-200">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">Nouveau mot de
                                passe (optionnel)</label>
                            <input type="password" name="password" id="password"
                                placeholder="Laisser vide pour ne pas changer"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring-emerald-200">
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-semibold text-gray-900 mb-2">Rôle
                                système</label>
                            <select name="role" id="role"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#079669] focus:ring-emerald-200">
                                <option value="membre" {{ $membre->role === 'membre' ? 'selected' : '' }}>Membre
                                    ordinaire</option>
                                <option value="admin" {{ $membre->role === 'admin' ? 'selected' : '' }}>Administrateur
                                    / Gestionnaire</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end items-center space-x-4 border-t border-gray-100 pt-4 mt-8">
                        <a href="{{ route('membres.index') }}"
                            class="px-5 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-100 rounded-lg">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-bold text-white bg-[#079669] hover:bg-[#047857] rounded-lg shadow-sm">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
