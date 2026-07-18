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

<div class="mb-4 grid grid-cols-12 items-center gap-4">
    @if($label)
        <label
            for="{{ $inputId }}"
            class="col-span-4 md:col-span-2 flex items-center font-satoshi-medium text-slate-700"
        >
            {{ $label }}
        </label>
    @endif

    <div class="{{ $label ? 'col-span-8 md:col-span-10' : 'col-span-12' }}">
        <input
            {{ $attributes->merge([
                'id' => $inputId,
                'type' => 'file',
                'name' => $name,
                'class' => 'block w-full rounded-xl border text-base font-satoshi-medium outline-none transition file:mr-4 file:py-3 file:px-4 file:border-0 file:border-r file:border-solid file:border-inherit file:bg-slate-50 file:text-slate-700 file:font-satoshi-medium hover:file:bg-slate-100 cursor-pointer focus:bg-white focus:ring-2 '.$statusClasses
            ]) }}
            data-placeholder="{{ $placeholder }}"
            onchange="this.style.color = this.files[0] ? 'inherit' : '#94a3b8';"
            style="color: #94a3b8;" 
        />

        @if($hasError)
            <span class="mt-1.5 block text-sm text-red-600">
                {{ $errors->first($name) }}
            </span>
        @endif
    </div>
</div>