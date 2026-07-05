<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">

    <div class="flex min-h-screen">
        
        <x-sidebar></x-sidebar>

        <div class="flex-1 flex flex-col overflow-hidden">

            @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        
                        <div class="text-gray-800 font-semibold text-xl">
                            {{ $header }}
                        </div>

                        <!-- ZONE DROPDOWN UTILISATEUR CORRIGÉE -->
                        <div class="flex items-center">
                            <div class="relative ms-3" x-data="{ open: false }">
                                <!-- Bouton Avatar (Déclencheur) -->
                                <button @click="open = !open" @click.away="open = false" class="inline-flex items-center justify-center rounded-full bg-purple-600 hover:bg-purple-700 text-white font-bold w-10 h-10 shadow transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 cursor-pointer uppercase select-none">
                                    {{ strtoupper(substr(auth()->user()->prenom ?? auth()->user()->nom ?? 'U', 0, 1)) }}
                                </button>

                                <!-- Menu déroulant fluide -->
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-52 rounded-md shadow-xl py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50" 
                                     style="display: none;">
                                    
                                    <!-- En-tête : Informations de la personne connectée -->
                                    <div class="px-4 py-2 border-b border-gray-100 bg-gray-50/50">
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Session active</p>
                                        <p class="text-sm font-bold text-gray-900 truncate mt-0.5">
                                            {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                                        </p>
                                    </div>

                                    <!-- Lien vers le profil -->
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                        ⚙️ Mon Profil
                                    </a>

                                    <!-- Bouton de Déconnexion sécurisé via POST -->
                                    <div class="border-t border-gray-100 mt-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold transition-colors">
                                                🚪 Se déconnecter
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </header>
            @endisset

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                {{ $slot }}
            </main>

        </div>
    </div>

</body>
</html>