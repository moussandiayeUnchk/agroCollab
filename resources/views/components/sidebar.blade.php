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

</aside>
