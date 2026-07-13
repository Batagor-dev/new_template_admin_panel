@props(['type' => 'text', 'value' => '', 'placeholder' => ''])

<input {{ $attributes->merge(['type' => $type, 'value' => $value, 'placeholder' => $placeholder, 'class' => 'block w-full font-satoshi-medium rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-base text-slate-900 outline-none transition focus:border-slate-400 focus:bg-white focus:ring-2 focus:ring-slate-200']) }} />
