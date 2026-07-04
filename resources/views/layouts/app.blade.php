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

                        <div class="flex items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center justify-center rounded-full bg-purple-600 hover:bg-purple-700 text-white font-bold w-10 h-10 shadow transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 cursor-pointer">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Mon Profil') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();"
                                                class="text-red-600 hover:text-red-700 font-medium">
                                            {{ __('Se déconnecter') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
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