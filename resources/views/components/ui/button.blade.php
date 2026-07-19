@props([
    'type' => 'button',
    'size' => 'md',
    'font' => 'medium',
    'href' => null
])

@php
    // Definisikan variasi ukuran (padding dan ukuran font)
    $sizes = [
        'sm' => 'px-3 py-2 text-sm rounded-lg',
        'md' => 'px-4 py-3 text-base rounded-2xl',
        'lg' => 'px-6 py-4 text-lg rounded-2xl',
    ];

    $fonts = [
        'medium' => 'font-satoshi-medium',
        'semibold' => 'font-satoshi-semibold',
        'bold' => 'font-satoshi-bold',
    ];

    // Ambil kelas ukuran yang dipilih, default ke 'md' jika tidak ditemukan
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $fontClass = $fonts[$font] ?? $fonts['medium'];

    // Gabungkan kelas dasar dengan kelas ukuran khusus
    $baseClasses = "inline-flex items-center justify-center bg-slate-900 text-white transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-300 " . $sizeClass . " " . $fontClass;
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