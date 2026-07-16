@props([
    'variant' => 'neutral', // neutral, primary, success, danger, warning
    'icon' => null,         // nama class icon (misal: 'ri-markup-line')
])

@php
    // Mapping variasi warna dasar badge
    $variants = [
        'neutral' => 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300',
        'primary' => 'bg-black text-white dark:bg-white dark:text-black',
        'success' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300',
        'danger'  => 'bg-rose-100 text-rose-700 dark:bg-rose-950/50 dark:text-rose-300',
        'warning' => 'bg-amber-100 text-amber-700 dark:bg-amber-950/50 dark:text-amber-300',
    ];

    $variantClass = $variants[$variant] ?? $variants['neutral'];
@endphp

<span {{ $attributes->merge([
    'class' => "inline-flex items-center gap-1.5 rounded-lg px-2 py-1 text-xs font-satoshi-semibold select-none $variantClass"
]) }}>
    {{-- Render icon jika diisi --}}
    @if($icon)
        <i class="{{ $icon }} text-sm shrink-0 opacity-80"></i>
    @endif
    
    <span>{{ $slot }}</span>
</span>