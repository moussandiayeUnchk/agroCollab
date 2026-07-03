<aside class="w-72 bg-[#079669] flex flex-col min-h-screen shadow-lg">
    <div class="mt-6 ml-6 mb-2">
        <h1 class="font-black text-white text-3xl tracking-wide">AgroCollab</h1>
    </div>
    <nav class="flex-1 mt-8 space-y-2 px-4">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard.*')">
            <span>📊</span>
            <span>Tableau de bord</span>
        </x-nav-link>
        <x-nav-link :href="route('membres.index')" :active="request()->routeIs('membres.*')">
            <span>👥</span>
            <span>Membres</span>
        </x-nav-link>
        <x-nav-link :href="route('intrants.index')" :active="request()->routeIs('intrants.*')">
            <span>📦</span>
            <span>Stocks</span>
        </x-nav-link>
        <x-nav-link :href="route('materiels.index')" :active="request()->routeIs('materiels*')">
            <span>🚜</span>
            <span>Matériels</span>
        </x-nav-link>
        <x-nav-link :href="route('recoltes.index')" :active="request()->routeIs('recoltes*')">
            <span>🌾</span>
            <span>Récoltes</span>
        </x-nav-link>
    </nav>

    <div class="px-4 py-5 mx-3 mb-4 rounded-xl bg-white/10 backdrop-blur">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#079669] font-black text-xl shadow">
                {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}
            </div>
            <div class="leading-tight">
                <p class="text-white font-bold text-sm">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
                <span class="text-xs font-medium px-2 py-0.5 rounded-full {{ Auth::user()->role === 'admin' ? 'bg-yellow-400 text-yellow-900' : 'bg-white/20 text-white' }}">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-white/20 hover:bg-white/30 text-white rounded-lg px-4 py-2 transition text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Déconnexion</span>
            </button>
        </form>
    </div>
</aside>
