<form method="GET" action="{{ $route ?: request()->url() }}" class="flex gap-2 items-center">
    {{-- Pertahankan query string lain selain search --}}
    @foreach(request()->except(['search', 'page']) as $key => $val)
        @if(is_array($val))
            @foreach($val as $v)
                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
            @endforeach
        @else
            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
        @endif
    @endforeach

    {{-- Extra hidden fields --}}
    @foreach($extras as $key => $val)
        <input type="hidden" name="{{ $key }}" value="{{ $val }}">
    @endforeach

    <div class="relative flex-1">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400 text-sm"></i>
        </div>
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="{{ $placeholder }}"
            class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#1e3a5f] focus:border-transparent"
            autocomplete="off">
        @if(request('search'))
            <a href="{{ request()->fullUrlWithoutQuery(['search', 'page']) }}"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-sm"></i>
            </a>
        @endif
    </div>
    <button type="submit"
        class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#2a4a7a] transition whitespace-nowrap">
        Cari
    </button>
    @if(request('search'))
        <a href="{{ request()->fullUrlWithoutQuery(['search', 'page']) }}"
            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300 transition whitespace-nowrap">
            Reset
        </a>
    @endif
</form>