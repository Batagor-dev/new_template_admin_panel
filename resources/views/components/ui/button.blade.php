@props([
    'type' => 'button',
    'size' => 'md',
    'font' => 'medium',
    'style' => 'primary',
    'href' => null
])

@php
    // Definisikan variasi ukuran (padding dan ukuran font)
    $sizes = [
        'sm' => 'px-4 py-2 text-sm rounded-lg',
        'md' => 'px-4 py-3 text-base rounded-2xl',
        'lg' => 'px-6 py-4 text-lg rounded-2xl',
    ];

    $fonts = [
        'medium' => 'font-satoshi-medium',
        'semibold' => 'font-satoshi-semibold',
        'bold' => 'font-satoshi-bold',
    ];

    $styles = [
        'primary' => 'bg-slate-900 text-white transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-300',
        'secondary' => 'bg-white text-slate-700 border border-slate-500 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-300',
        'danger' => 'bg-red-500 text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300',
    ];

    // Ambil kelas ukuran yang dipilih, default ke 'md' jika tidak ditemukan
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $fontClass = $fonts[$font] ?? $fonts['medium'];
    $styleClass = $styles[$style] ?? $styles['primary'];

    // Gabungkan kelas dasar dengan kelas ukuran khusus
    $baseClasses = "inline-flex items-center justify-center  transition focus:outline-none focus:ring-2 focus:ring-slate-300 " . $sizeClass . " " . $fontClass . " " . $styleClass;
@endphp

@if ($href)
    {{-- Jika memiliki atribut href, render sebagai tag <a> --}}
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </a>
@else
    {{-- Jika tidak memiliki href, render sebagai tag <button> standar --}}
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </button>
@endif