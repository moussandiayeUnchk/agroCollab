<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ('Tableau de bord') }}
        </h2>
    </x-slot>

     <h3 class="text-xl">Vue d'ensemble</h3>

     <!-- infos ou statistiques sur les sur les éléments de la coopértive  -->
     
     <div class="flex mt-5 justify-evenly ">
        <div class="flex flex-col border-b-4 border-b-green-600 justify-center items-center shadow-md w-60 h-40 p-4 rounded-md space-y-2 ">
            <p class="text-3xl font-bold">{{ $totalMembres }}</p>
            <p  class="text-xl text-gray-400 font-bold">Membre actifs</p>
        </div>

        <div class="flex flex-col border-b-4 border-b-orange-600 justify-center items-center shadow-xl w-60 h-40 p-4 rounded-md space-y-2 ">
            <p class="text-3xl font-bold">{{ $totalRecoltes }} T</p>
            <p  class="text-xl text-gray-400 font-bold">Volume de récoltes</p>
        </div>

        <div class="flex flex-col border-b-4  border-b-purple-600 justify-center items-center shadow-xl w-60 h-40 p-4 rounded-md space-y-2 ">
            <p class="text-3xl font-bold">{{ $materielsDisponible }} / {{ $totalMateriels }}</p>
            <p  class="text-xl text-gray-400 font-bold">Matériels disponibles</p>
        </div>

        <div class="flex flex-col border-b-4  border-b-red-600 justify-center items-center shadow-xl w-60 h-40 p-4 rounded-md space-y-2 ">
            <p class="text-3xl font-bold">{{ $alerteStock }}</p>
            <p  class="text-xl text-gray-400 font-bold">Alertes stock bas</p>
        </div>
       
     </div>

   
</x-app-layout>
