@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';
    $breadcrumbsData = Breadcrumbs::generate(Request::route()->getName());
@endphp

@extends('layouts.backend.main')

@section('title', 'System Settings')
@section('sub_title', $sub_title)

@section('breadcrumb')
    <x-layout.admin.breadcrumb :breadcrumbs="$breadcrumbsData" />
@endsection

@section('content')
    <div class="space-y-6">
        <x-ui.card>
            <form method="POST" action="{{ $action }}" class="space-y-6" enctype="multipart/form-data">
                @csrf
                
                <div>
                    <h5 class="text-lg font-satoshi-bold text-slate-900 mb-4">{{ $sub_title }}</h5>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <x-ui.input 
                            name="title" 
                            label="Title" 
                            placeholder="Site title" 
                            value="{{ old('title', $title ?? '') }}"
                            required
                        />

                        <!-- Author -->
                        <x-ui.input 
                            name="author" 
                            label="Author" 
                            placeholder="Author name" 
                            value="{{ old('author', $author ?? '') }}"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Keyword (Tagify) -->
                        <x-ui.tagify 
                            name="keyword" 
                            label="Keyword" 
                            placeholder="Add site keywords..." 
                            value="{{ old('keyword', $keyword ?? '') }}"
                        />

                        <!-- Favicon -->
                        <x-ui.file
                            name="favicon"
                            label="Favicon"
                            :previewUrl="isset($favicon) ? asset('storage/'.$favicon) : asset('images/no-image.png')"
                        />
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <label for="description" class="mb-2 block text-base font-satoshi-medium text-slate-700">Description</label>
                        <textarea class="block w-full font-satoshi-medium rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-base outline-none transition focus:bg-white focus:ring-2 focus:ring-slate-200 @error('description') border-red-400 bg-red-50/50 text-red-900 @enderror"
                                  id="description"
                                  name="description"
                                  placeholder="Description"
                                  rows="4"
                                  maxlength="160">{{ old('description', $description ?? '') }}</textarea>
                        <div class="mt-1.5 flex justify-between items-center text-xs text-slate-400 font-satoshi">
                            <span>Sisa karakter: <span id="count" class="font-satoshi-bold text-slate-500">160</span></span>
                            <span>Maksimal 160 karakter</span>
                        </div>
                        @error('description')
                            <span class="mt-1.5 block text-sm font-medium text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="pt-6 border-t border-slate-100 flex items-center justify-end">
                    <x-ui.button type="submit" font="bold" size="sm">
                        Save Settings
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection

@push('scripts')
<script>
    /* ---------- Description counter ------ */
    const desc = document.getElementById('description');
    const cnt  = document.getElementById('count');
    const max  = 160;

    function setCount() {
        const remaining = max - desc.value.length;
        cnt.textContent = remaining > 0 ? remaining : 0;
    }
    setCount();
    desc.addEventListener('input', setCount);
</script>
@endpush