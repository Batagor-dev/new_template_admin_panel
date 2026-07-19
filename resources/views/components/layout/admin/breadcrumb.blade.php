@props(['breadcrumbs' => []])

@if(!empty($breadcrumbs))
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            @foreach($breadcrumbs as $breadcrumb)
                @if($loop->first)
                    <!-- Item Pertama (Dashboard / Home) -->
                    <li class="inline-flex items-center">
                        <a href="{{ $breadcrumb->url }}" class="inline-flex items-center text-lg font-satoshi-medium text-slate-500 hover:text-slate-900 transition-colors">
                            {{ $breadcrumb->title }}
                        </a>
                    </li>
                @else
                    <!-- Item Selanjutnya menggunakan properti object (->) bukan array (['']) -->
                    <li>
                        <div class="flex items-center">
                            <i class="ri-arrow-right-s-line text-slate-400 text-lg mx-1"></i>
                            @if(!empty($breadcrumb->url) && !$loop->last)
                                <a href="{{ $breadcrumb->url }}" class="text-lg font-satoshi-medium text-slate-500 hover:text-slate-900 transition-colors font-satoshi-medium">
                                    {{ $breadcrumb->title }}
                                </a>
                            @else
                                <span class="text-lg font-satoshi-medium text-slate-800">
                                    {{ $breadcrumb->title }}
                                </span>
                            @endif
                        </div>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif