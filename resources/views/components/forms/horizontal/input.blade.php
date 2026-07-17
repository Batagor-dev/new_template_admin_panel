@props([
    'type' => 'text', 
    'value' => '', 
    'placeholder' => '',
    'name' => '',
    'label' => ''
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

<div class="mb-4 grid grid-cols-12 items-center gap-4">
    @if($label)
        <!-- Ganti col-sm-3 menjadi col-span-3 (atau md:col-span-3 agar responsif) -->
        <label
            for="{{ $inputId }}"
            class="col-span-3 flex items-center font-satoshi-medium text-slate-700"
        >
            {{ $label }}
        </label>
    @endif

    <!-- Ganti col-sm-9 / col-sm-12 menjadi col-span-9 / col-span-12 -->
    <div class="{{ $label ? 'col-span-9' : 'col-span-12' }}">
        <input
            {{ $attributes->merge([
                'id' => $inputId,
                'type' => $type,
                'value' => $value,
                'placeholder' => $placeholder,
                'name' => $name,
                'class' => 'block w-full rounded-xl border px-4 py-3 text-base font-satoshi-medium outline-none transition focus:bg-white focus:ring-2 '.$statusClasses
            ]) }}
        />

        @if($hasError)
            <span class="mt-1.5 block text-sm text-red-600">
                {{ $errors->first($name) }}
            </span>
        @endif
    </div>
</div>