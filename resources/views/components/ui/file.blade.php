@props([
    'name' => '',
    'label' => '',
    'placeholder' => 'No file chosen'
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

<div class="w-full">
    @if($label)
        <label for="{{ $inputId }}" class="mb-2 block text-base font-satoshi-medium text-slate-700">
            {{ $label }}
        </label>
    @endif

    <input
        {{ $attributes->merge([
            'id' => $inputId,
            'type' => 'file',
            'name' => $name,
            'class' => 'block w-full rounded-2xl border text-base font-satoshi-medium outline-none transition file:mr-4 file:py-3 file:px-4 file:border-0 file:border-r file:border-solid file:border-inherit file:bg-slate-50 file:text-slate-700 file:font-satoshi-medium hover:file:bg-slate-100 cursor-pointer focus:bg-white focus:ring-2 '.$statusClasses
        ]) }}
        data-placeholder="{{ $placeholder }}"
        onchange="this.style.color = this.files[0] ? 'inherit' : '#94a3b8';"
        style="color: #94a3b8;" 
    />

    @if($hasError)
        <span class="mt-1.5 block text-sm font-medium text-red-600">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>
