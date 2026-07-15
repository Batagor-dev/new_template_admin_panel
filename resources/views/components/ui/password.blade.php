@props([
    'name',
    'id' => null,
    'label' => '',
    'placeholder' => '••••••••',
    'required' => false,
    'class' => '',
])

@php
    // Gunakan id jika dikirim, jika tidak, otomatis gunakan name sebagai id
    $inputId = $id ?? $name;

    // Cek apakah ada error untuk input dengan nama ini
    $hasError = $errors->has($name);

    // Atur class border dinamis berdasarkan status error
    $statusClasses = $hasError 
        ? 'border-red-400 bg-red-50/50 text-red-900 focus:border-red-500 focus:ring-red-100' 
        : 'border-slate-200 bg-slate-50 text-slate-900 focus:border-slate-400 focus:ring-slate-200';
@endphp

<div class="w-full">
    {{-- Label dinamis mengikuti prop label --}}
    @if($label)
        <label for="{{ $inputId }}" class="mb-2 block text-base font-satoshi-medium text-slate-700">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <input
            id="{{ $inputId }}"
            name="{{ $name }}"
            type="password"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            data-password-input
            {{ $attributes->merge([
                'class' => 'block w-full rounded-2xl border px-4 py-3 pr-12 text-base font-satoshi-medium outline-none transition focus:bg-white focus:ring-2 ' . $statusClasses . ' ' . $class
            ]) }}
        >

        {{-- Tombol Toggle Show/Hide Password --}}
        <button
            type="button"
            data-password-toggle
            data-target="{{ $inputId }}"
            class="absolute inset-y-0 right-3 flex items-center text-slate-500 transition hover:text-slate-900"
        >
            <i data-eye-open class="ri-eye-line text-xl"></i>
            <i data-eye-close class="ri-eye-off-line hidden text-xl"></i>
        </button>
    </div>

    {{-- Pesan error dinamis --}}
    @if($hasError)
        <span class="mt-1.5 block text-sm font-medium text-red-600">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>

{{-- Script diletakkan sekali menggunakan @once agar tidak terjadi duplikasi script --}}
@once
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll("[data-password-toggle]").forEach((button) => {
                button.addEventListener("click", () => {
                    const input = document.getElementById(button.dataset.target);

                    if (!input) return;

                    const eyeOpen = button.querySelector("[data-eye-open]");
                    const eyeClose = button.querySelector("[data-eye-close]");

                    const isHidden = input.type === "password";

                    input.type = isHidden ? "text" : "password";

                    eyeOpen.classList.toggle("hidden", isHidden);
                    eyeClose.classList.toggle("hidden", !isHidden);
                });
            });
        });
    </script>
    @endpush
@endonce