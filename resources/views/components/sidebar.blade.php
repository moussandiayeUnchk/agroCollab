

    <!-- la barre latérale (sidebar) -->
    <aside class="w-70 bg-[#079669] flex flex-col min-h-screen">

        <!-- Entête nom du projet -->
        <div class="mt-4 ml-4">
            <h1 class="font-bold text-white text-3xl">AgroCollab</h1>
        </div>

        <!-- lien de navigation -->
        <nav class="flex-1 mt-8  space-y-6 ml-4">

            <!-- injection du composant qu'on aréé dans le dossier component nav-link.blade.php -->
            <x-nav-link href="/" :active="request()->is('dashboard')" class="flex items-center space-x-2 text-xl ">
                <span>📊</span>
                <span>Tableau de bord</span>

            </x-nav-link>


            <x-nav-link href="/" :active="request()->is('dashboard')" class="flex items-center space-x-2 text-xl">
                <span>👥</span>
                <span>Membres</span>

            </x-nav-link>


            <x-nav-link href="/" :active="request()->is('dashboard')" class="flex items-center space-x-2 text-xl">
                <span>📦</span>
                <span>Stocks</span>

            </x-nav-link>


            <x-nav-link href="/" :active="request()->is('dashboard')" class="flex items-center space-x-2 text-xl">
                <span>🚜</span>
                <span>Matériels</span>

            </x-nav-link>


            <x-nav-link href="/" :active="request()->is('dashboard')"  class="flex items-center space-x-2 text-xl">
                <span>🌾</span>
                <span>Récoltes</span>

            </x-nav-link>









        </nav>

    </aside>
