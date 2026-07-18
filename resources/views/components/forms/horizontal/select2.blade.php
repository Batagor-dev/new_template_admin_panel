@props([
    'name' => '',
    'label' => '',
    'placeholder' => 'Pilih opsi...',
    'multiple' => false,
    'options' => [], // Menerima koleksi/array riil dari Laravel
    'value' => null  // Menerima nilai default (misal: old value atau data edit)
])

@php
    $hasError = $name && $errors->has($name);
    $statusClasses = $hasError 
        ? 'border-red-400 bg-red-50/50 text-red-900 focus-within:border-red-500 focus-within:ring-red-100' 
        : 'border-slate-200 bg-white text-slate-900 focus-within:border-slate-400 focus-within:ring-slate-200';
    
    $inputId = $attributes->get('id', $name);

    // Konversi value ke format array untuk Alpine.js (karena multiple berupa array)
    // Jika formatnya string/integer tunggal, bungkus jadi array.
    $initialValue = [];
    if (!empty($value)) {
        $initialValue = is_array($value) || $value instanceof \Illuminate\Support\Collection 
            ? array_map('strval', $value instanceof \Illuminate\Support\Collection ? $value->toArray() : $value)
            : [strval($value)];
    }
@endphp

<div class="mb-4 grid grid-cols-12 items-center gap-4" 
     x-data="select2Laravel({ 
        multiple: {{ $multiple ? 'true' : 'false' }}, 
        options: {{ json_encode($options) }},
        placeholder: '{{ $placeholder }}',
        selected: {{ json_encode($initialValue) }}
     })">
     
    @if($label)
        <label for="{{ $inputId }}" class="col-span-4 md:col-span-2 flex items-center font-satoshi-medium text-slate-700">
            {{ $label }}
        </label>
    @endif

    <div class="{{ $label ? 'col-span-8 md:col-span-10' : 'col-span-12' }} relative">
        
        <!-- Input Box / Trigger Trigger Dropdown -->
        <div @click="toggleDropdown()" 
             @click.away="closeDropdown()"
             class="flex min-h-[50px] w-full items-center justify-between rounded-xl border px-4 py-2 text-base font-satoshi-medium cursor-pointer outline-none transition focus-within:ring-2 {{ $statusClasses }}">
            
            <div class="flex flex-wrap gap-1.5 items-center w-full overflow-hidden">
                <template x-if="selected.length === 0">
                    <span class="text-slate-400 font-satoshi">{{ $placeholder }}</span>
                </template>

                <!-- Mode Single (Basic) -->
                <template x-if="!multiple && selected.length > 0">
                    <span class="text-slate-900" x-text="options[selected[0]]"></span>
                </template>

                <!-- Mode Multiple -->
                <template x-if="multiple" x-for="val in selected" :key="val">
                    <div class="flex items-center gap-1 bg-slate-100 text-slate-800 text-sm px-2.5 py-1 rounded-lg border border-slate-200">
                        <span x-text="options[val]"></span>
                        <button type="button" @click.stop="removeValue(val)" class="text-slate-400 hover:text-slate-600 font-bold ml-1 text-xs">&times;</button>
                    </div>
                </template>
            </div>

            <svg class="w-4 h-4 text-slate-400 transition-transform shrink-0 ml-2" :class="isOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>

        <!-- Hidden input untuk disubmit ke backend Laravel -->
        <template x-if="!multiple">
            <input type="hidden" name="{{ $name }}" :value="selected[0] || ''">
        </template>
        <template x-if="multiple">
            <template x-for="val in selected">
                <input type="hidden" name="{{ $name }}[]" :value="val">
            </template>
        </template>

        <!-- Dropdown Area -->
        <div x-show="isOpen" 
             x-transition
             class="absolute z-50 mt-2 w-full bg-white border border-slate-200 rounded-xl shadow-lg max-h-60 overflow-y-auto p-2" 
             style="display: none;">
            
            <div class="sticky top-0 bg-white pb-2 pt-0.5">
                <input type="text" 
                       x-model="search" 
                       placeholder="Cari..." 
                       class="w-full px-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg outline-none focus:border-slate-400 focus:bg-white transition"
                       @click.stop />
            </div>

            <ul class="space-y-0.5">
                <template x-for="(label, val) in filteredOptions" :key="val">
                    <li @click="selectValue(val)"
                        class="px-3 py-2 text-sm rounded-lg cursor-pointer transition flex items-center justify-between"
                        :class="isSelected(val) ? 'bg-indigo-50 text-indigo-700 font-satoshi-medium' : 'text-slate-700 hover:bg-slate-50'">
                        <span x-text="label"></span>
                        
                        <template x-if="isSelected(val)">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </template>
                    </li>
                </template>
                
                <template x-if="Object.keys(filteredOptions).length === 0">
                    <li class="px-3 py-4 text-sm text-center text-slate-400">Data tidak ditemukan</li>
                </template>
            </ul>
        </div>

        @if($hasError)
            <span class="mt-1.5 block text-sm text-red-600">
                {{ $errors->first($name) }}
            </span>
        @endif
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('select2Laravel', (config) => ({
            multiple: config.multiple,
            options: config.options,
            isOpen: false,
            search: '',
            selected: config.selected || [],

            toggleDropdown() { this.isOpen = !this.isOpen; if(this.isOpen) this.search = ''; },
            closeDropdown() { this.isOpen = false; },
            isSelected(val) { return this.selected.includes(String(val)); },
            selectValue(val) {
                val = String(val);
                if (this.multiple) {
                    if (this.isSelected(val)) {
                        this.selected = this.selected.filter(i => i !== val);
                    } else {
                        this.selected.push(val);
                    }
                } else {
                    this.selected = [val];
                    this.closeDropdown();
                }
            },
            removeValue(val) {
                this.selected = this.selected.filter(i => i !== String(val));
            },
            get filteredOptions() {
                if (!this.search) return this.options;
                return Object.keys(this.options)
                    .filter(key => String(this.options[key]).toLowerCase().includes(this.search.toLowerCase()))
                    .reduce((obj, key) => {
                        obj[key] = this.options[key];
                        return obj;
                    }, {});
            }
        }));
    });
</script>