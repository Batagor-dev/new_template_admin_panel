@props([
    'name' => '',
    'label' => '',
    'placeholder' => 'Add tags...',
    'value' => ''
])

@php
    $hasError = $name && $errors->has($name);
    $statusClasses = $hasError 
        ? 'border-red-400 bg-red-50/50 text-red-900 focus-within:border-red-500 focus-within:ring-red-100' 
        : 'border-slate-200 bg-slate-50 text-slate-900 focus-within:border-slate-400 focus-within:ring-slate-200';
    
    $inputId = $attributes->get('id', $name);
@endphp

@once
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
        <style>
            /* Custom styling tagify agar serasi dengan monokrom NewTemplate */
            .tagify {
                --tags-border-color: transparent;
                --tags-hover-border-color: transparent;
                --tags-focus-border-color: transparent;
                --tag-bg: #e2e8f0; /* bg-slate-200 */
                --tag-hover: #cbd5e1; /* bg-slate-300 */
                --tag-text-color: #1e293b; /* text-slate-800 */
                --tag-remove-bg: #cbd5e1;
                --tag-remove-btn-color: #475569;
                --tag-remove-btn-bg--hover: #f1f5f9;
                --tag-pad: 0.3rem 0.6rem;
                --tag-inset-shadow-size: 0;
                --placeholder-color: #94a3b8;
                border-radius: 1rem !important; /* rounded-2xl */
                font-family: 'Satoshi', sans-serif;
                font-weight: 500;
                padding: 0.25rem 0.5rem !important;
                background-color: transparent;
                width: 100%;
            }
            .tagify:hover {
                border-color: transparent;
            }
            .tagify__input {
                margin: 0.15rem !important;
                padding: 0.25rem 0.5rem !important;
            }
            .tagify__tag {
                margin: 0.25rem !important;
                border-radius: 0.5rem !important;
            }
            .tagify__tag > div {
                border-radius: 0.5rem !important;
            }
            .tagify__tag__removeBtn {
                margin-left: 0.35rem !important;
                border-radius: 50% !important;
            }
        </style>
    @endpush
@endonce

<div class="w-full text-left" 
     x-data="{
        tagify: null,
        init() {
            this.tagify = new Tagify(this.$refs.tagInput, {
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
                placeholder: '{{ $placeholder }}'
            });
        }
     }">
    
    @if($label)
        <label for="{{ $inputId }}" class="mb-2 block text-base font-satoshi-medium text-slate-700">
            {{ $label }}
        </label>
    @endif

    <div class="w-full rounded-2xl border px-2 py-1.5 text-base font-satoshi-medium outline-none transition focus-within:ring-2 focus-within:bg-white {{ $statusClasses }}">
        <input 
            {{ $attributes->merge([
                'id' => $inputId,
                'name' => $name,
                'value' => $value
            ]) }} 
            x-ref="tagInput"
            class="hidden"
        />
    </div>

    @if($hasError)
        <span class="mt-1.5 block text-sm font-medium text-red-600">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>

@once
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    @endpush
@endonce
