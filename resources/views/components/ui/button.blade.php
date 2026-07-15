@props(['type' => 'button'])

<button {{ $attributes->merge(['type' => $type, 'class' => 'inline-flex items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-base font-satoshi-bold text-white transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-300']) }}>
  {{ $slot }}
</button>
