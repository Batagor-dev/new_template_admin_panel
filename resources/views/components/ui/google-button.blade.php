@props(['href', 'label' => 'Masuk dengan Google'])

<a href="{{ $href }}" class="inline-flex w-full items-center justify-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-200">
    <i class="ri-google-line text-xl"></i>
    <span>{{ $label }}</span>
</a>
