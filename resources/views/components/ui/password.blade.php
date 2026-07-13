@props([
    'id',
    'name',
    'placeholder' => '',
    'required' => false,
    'class' => '',
])

<div class="relative">
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="password"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        data-password-input
        {{ $attributes->merge([
            'class' => 'block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-base font-satoshi-medium text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-2 focus:ring-slate-200 ' . $class
        ]) }}
    >

    <button
        type="button"
        data-password-toggle
        data-target="{{ $id }}"
        class="absolute inset-y-0 right-3 flex items-center text-slate-500 transition hover:text-slate-900"
    >
        <i data-eye-open class="ri-eye-line text-xl"></i>
        <i data-eye-close class="ri-eye-off-line hidden text-xl"></i>
    </button>
</div>


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