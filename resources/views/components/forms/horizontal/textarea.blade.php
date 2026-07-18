@props([
    'value' => '', 
    'placeholder' => '',
    'name' => '',
    'label' => '',
    'rows' => '4'
])

@php
    // Cek apakah ada error untuk input dengan nama ini
    $hasError = $name && $errors->has($name);

    // Atur class border dan ring secara dinamis berdasarkan status error
    $statusClasses = $hasError 
        ? 'border-red-400 bg-red-50/50 text-red-900 focus:border-red-500 focus:ring-red-100' 
        : 'border-slate-200 bg-white text-slate-900 focus:border-slate-400 focus:ring-slate-200';
    
    // Gunakan id dari attributes jika ada, jika tidak ada gunakan name sebagai fallback id
    $inputId = $attributes->get('id', $name);
@endphp

<div class="mb-4 grid grid-cols-12 items-start gap-4">
    @if($label)
        <!-- Menggunakan items-start (bukan items-center) agar teks label tetap di atas saat textarea meninggi -->
        <label
            for="{{ $inputId }}"
            class="col-span-4 md:col-span-2 flex items-start pt-3 font-satoshi-medium text-slate-700"
        >
            {{ $label }}
        </label>
    @endif

    <div class="{{ $label ? 'col-span-8 md:col-span-10' : 'col-span-12' }}">
        <textarea
            {{ $attributes->merge([
                'id' => $inputId,
                'name' => $name,
                'rows' => $rows,
                'placeholder' => $placeholder,
                'class' => 'block w-full rounded-xl border px-4 py-3 text-base font-satoshi-medium outline-none transition resize-y focus:bg-white focus:ring-2 '.$statusClasses
            ]) }}
        >{{ $value }}</textarea>

        @if($hasError)
            <span class="mt-1.5 block text-sm text-red-600">
                {{ $errors->first($name) }}
            </span>
        @endif
    </div>
</div>