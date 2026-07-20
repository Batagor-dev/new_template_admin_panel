@props([
    'name' => '',
    'label' => '',
    'placeholder' => 'Tulis konten di sini...',
    'value' => ''
])

@php
    $hasError = $name && $errors->has($name);
    $statusClasses = $hasError 
        ? 'border-red-400 focus-within:border-red-500' 
        : 'border-slate-200 focus-within:border-slate-400';
    
    $inputId = $attributes->get('id', $name);
@endphp

@once
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.snow.css" rel="stylesheet">
        <style>
            /* Custom Quill Editor premium styling */
            .ql-toolbar.ql-snow {
                border-top-left-radius: 1rem !important;
                border-top-right-radius: 1rem !important;
                border: 1px solid #e2e8f0 !important;
                background-color: #f8fafc !important; /* slate-50 */
                padding: 0.75rem !important;
            }
            .ql-container.ql-snow {
                border-bottom-left-radius: 1rem !important;
                border-bottom-right-radius: 1rem !important;
                border: 1px solid #e2e8f0 !important;
                border-top: none !important;
                font-family: 'Satoshi', sans-serif !important;
                font-size: 1rem !important;
                background-color: #f8fafc;
            }
            .ql-editor {
                min-height: 250px;
                font-family: 'Satoshi', sans-serif !important;
                color: #1e293b !important; /* slate-800 */
                padding: 1rem !important;
                background-color: #ffffff;
                border-bottom-left-radius: 1rem !important;
                border-bottom-right-radius: 1rem !important;
            }
            .ql-editor.ql-blank::before {
                color: #94a3b8 !important; /* slate-400 */
                font-style: normal !important;
                left: 1rem !important;
            }
            .ql-snow.ql-toolbar button:hover,
            .ql-snow .ql-toolbar button:hover,
            .ql-snow.ql-toolbar button:focus,
            .ql-snow .ql-toolbar button:focus,
            .ql-snow.ql-toolbar button.ql-active,
            .ql-snow .ql-toolbar button.ql-active,
            .ql-snow.ql-toolbar .ql-picker-label:hover,
            .ql-snow .ql-toolbar .ql-picker-label:hover,
            .ql-snow.ql-toolbar .ql-picker-label.ql-active,
            .ql-snow .ql-toolbar .ql-picker-label.ql-active,
            .ql-snow.ql-toolbar .ql-picker-item:hover,
            .ql-snow .ql-toolbar .ql-picker-item:hover,
            .ql-snow.ql-toolbar .ql-picker-item.ql-selected,
            .ql-snow .ql-toolbar .ql-picker-item.ql-selected {
                color: #0f172a !important; /* Slate 900 */
            }
            .ql-snow.ql-toolbar button:hover .ql-stroke,
            .ql-snow .ql-toolbar button:hover .ql-stroke,
            .ql-snow.ql-toolbar button:focus .ql-stroke,
            .ql-snow .ql-toolbar button:focus .ql-stroke,
            .ql-snow.ql-toolbar button.ql-active .ql-stroke,
            .ql-snow .ql-toolbar button.ql-active .ql-stroke,
            .ql-snow.ql-toolbar .ql-picker-label:hover .ql-stroke,
            .ql-snow .ql-toolbar .ql-picker-label:hover .ql-stroke,
            .ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-stroke,
            .ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-stroke,
            .ql-snow.ql-toolbar .ql-picker-item:hover .ql-stroke,
            .ql-snow .ql-toolbar .ql-picker-item:hover .ql-stroke,
            .ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-stroke,
            .ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-stroke,
            .ql-snow.ql-toolbar button:hover .ql-stroke-miter,
            .ql-snow .ql-toolbar button:hover .ql-stroke-miter,
            .ql-snow.ql-toolbar button:focus .ql-stroke-miter,
            .ql-snow .ql-toolbar button:focus .ql-stroke-miter,
            .ql-snow.ql-toolbar button.ql-active .ql-stroke-miter,
            .ql-snow .ql-toolbar button.ql-active .ql-stroke-miter,
            .ql-snow.ql-toolbar .ql-picker-label:hover .ql-stroke-miter,
            .ql-snow .ql-toolbar .ql-picker-label:hover .ql-stroke-miter,
            .ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-stroke-miter,
            .ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-stroke-miter,
            .ql-snow.ql-toolbar .ql-picker-item:hover .ql-stroke-miter,
            .ql-snow .ql-toolbar .ql-picker-item:hover .ql-stroke-miter,
            .ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-stroke-miter,
            .ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-stroke-miter {
                stroke: #0f172a !important;
            }
            .ql-snow.ql-toolbar button:hover .ql-fill,
            .ql-snow .ql-toolbar button:hover .ql-fill,
            .ql-snow.ql-toolbar button:focus .ql-fill,
            .ql-snow .ql-toolbar button:focus .ql-fill,
            .ql-snow.ql-toolbar button.ql-active .ql-fill,
            .ql-snow .ql-toolbar button.ql-active .ql-fill,
            .ql-snow.ql-toolbar .ql-picker-label:hover .ql-fill,
            .ql-snow .ql-toolbar .ql-picker-label:hover .ql-fill,
            .ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-fill,
            .ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-fill,
            .ql-snow.ql-toolbar .ql-picker-item:hover .ql-fill,
            .ql-snow .ql-toolbar .ql-picker-item:hover .ql-fill,
            .ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-fill,
            .ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-fill {
                fill: #0f172a !important;
            }
        </style>
    @endpush
@endonce

<div class="w-full text-left" 
     x-data="{
        editor: null,
        content: @js($value),
        init() {
            this.editor = new Quill(this.$refs.quillEditor, {
                theme: 'snow',
                placeholder: '{{ $placeholder }}',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'font': [] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                }
            });

            // Load initial content
            if (this.content) {
                this.editor.root.innerHTML = this.content;
                this.$refs.hiddenInput.value = this.content; // Sync initial raw HTML to hidden input
            }

            // Sync with hidden input
            this.editor.on('text-change', () => {
                let html = this.editor.root.innerHTML;
                if (html === '<p><br></p>') html = '';
                this.content = html;
                this.$refs.hiddenInput.value = html;
                // Dispatch input event for external tracking if any
                this.$refs.hiddenInput.dispatchEvent(new Event('input'));
            });
        }
     }">
    
    @if($label)
        <label for="{{ $inputId }}" class="mb-2 block text-base font-satoshi-medium text-slate-700">
            {{ $label }}
        </label>
    @endif

    <div class="w-full transition rounded-2xl {{ $statusClasses }}">
        <input 
            type="hidden" 
            id="{{ $inputId }}" 
            name="{{ $name }}" 
            x-ref="hiddenInput"
            value="{{ $value }}"
        />
        
        <div x-ref="quillEditor" class="w-full"></div>
    </div>

    @if($hasError)
        <span class="mt-1.5 block text-sm font-medium text-red-600">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>

@once
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.min.js"></script>
    @endpush
@endonce
