@props(["isFullPage" => false, "slug" => ""])
<li>
    @if ($isFullPage)
        @php
            if (! empty($slug)) {
                $array = [
                    route('web.employees.index'),
                    "?",
                    config("staff-pages.queryDepartmentKey"),
                    "[0]",
                    "=",
                    $slug
                ];
                $url = implode("", $array);
            } else { $url = "#"; }
        @endphp

        <a href="{{ $url }}"
           class="btn btn-sm btn-outline-secondary mr-indent-xs mt-indent-xs xs:mt-indent-half">
            {{ $slot }}
        </a>
    @else
        <div class="
            flex flex-nowrap items-center justify-center
            {{ $isFullPage ? 'h-7.5' : 'h-5 xs:h-7.5' }} px-indent-xs mr-indent-xs mt-indent-xs xs:mt-indent-half
            {{ $isFullPage ? 'text-sm' : 'text-xs xs:text-sm' }} text-nowrap font-medium
            rounded-base bg-light
        ">{{ $slot }}</div>
    @endif
</li>
