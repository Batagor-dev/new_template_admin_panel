@props(['items' => []])

@if(!empty($items))
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">
                    <i class="ri-home-4-line mr-1.5 text-base"></i>
                    Dashboard
                </a>
            </li>
            @foreach($items as $item)
                <li>
                    <div class="flex items-center">
                        <i class="ri-arrow-right-s-line text-slate-400 text-base mx-1"></i>
                        @if(!empty($item['url']))
                            <a href="{{ $item['url'] }}" class="text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">
                                {{ $item['label'] }}
                            </a>
                        @else
                            <span class="text-sm font-medium text-slate-800">
                                {{ $item['label'] }}
                            </span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>
@endif