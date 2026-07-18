@props([
    'checked' => false,
    'name' => '',
    'label' => '',
    'value' => '1'
])

@php
    // Cek apakah ada error untuk switch dengan nama ini
    $hasError = $name && $errors->has($name);
    
    // Gunakan id dari attributes jika ada, jika tidak ada gunakan name sebagai fallback id
    $inputId = $attributes->get('id', $name);
@endphp

<div class="mb-4 grid grid-cols-12 items-center gap-4">
    @if($label)
        <label
            for="{{ $inputId }}"
            class="col-span-4 md:col-span-2 flex items-center font-satoshi-medium text-slate-700 cursor-pointer"
        >
            {{ $label }}
        </label>
    @endif

    <div class="{{ $label ? 'col-span-8 md:col-span-10' : 'col-span-12' }} flex items-center h-[50px]">
        <!-- h-[50px] menjaga agar tinggi baris ini setara dengan input text (py-3 + text) -->
        <label class="relative inline-flex items-center cursor-pointer select-none">
            <input
                {{ $attributes->merge([
                    'id' => $inputId,
                    'type' => 'checkbox',
                    'name' => $name,
                    'value' => $value,
                    'class' => 'sr-only peer'
                ]) }}
                {{ $checked ? 'checked' : '' }}
            />
            
            <!-- Area Background Switch -->
            <div class="w-11 h-6 bg-slate-200 rounded-full transition-colors duration-200 ease-in-out 
                peer-focus:ring-2 peer-focus:ring-slate-200
                peer-checked:bg-black
                {{ $hasError ? 'border border-red-400 bg-red-50/50 peer-focus:ring-red-100' : '' }}">
            </div>
            
            <!-- Bulatan Slider -->
            <div class="absolute left-0.5 top-0.5 bg-white w-5 h-5 rounded-full shadow transition-transform duration-200 ease-in-out
                peer-checked:translate-x-full">
            </div>
        </label>

        @if($hasError)
            <span class="ml-4 text-sm text-red-600">
                {{ $errors->first($name) }}
            </span>
        @endif
    </div>
</div>