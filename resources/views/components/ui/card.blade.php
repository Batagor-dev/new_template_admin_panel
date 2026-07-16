@props([
    // Kita tentukan warna background default di sini
    'bg' => 'bg-white'
])

<div {{ $attributes->merge(['class' => "rounded-3xl p-6 shadow-lg shadow-slate-100/50 $bg"]) }}>
    {{ $slot }}
</div>