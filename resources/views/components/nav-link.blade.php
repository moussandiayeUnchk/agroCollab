@props(['active'])

@php
$classes = ($active ?? false)
            // 1. STYLE QUAND LA PAGE EST ACTIVE (L'utilisateur est sur cette page)
            // Fond vert plus foncé (hover:bg-[#047857]), texte blanc, écriture grasse
            ? 'flex items-center space-x-3 px-4 py-3 rounded-lg bg-[#047857] text-white font-bold text-[17px] transition-colors duration-150 shadow-sm'
            
            // 2. STYLE QUAND LA PAGE EST INACTIVE (Les autres pages)
            // Pas de fond, texte blanc ou légèrement opaque, changement de fond au survol
            : 'flex items-center space-x-3 px-4 py-3 rounded-lg text-emerald-100 hover:bg-[#047857] hover:text-white font-bold text-[17px] transition-colors duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>