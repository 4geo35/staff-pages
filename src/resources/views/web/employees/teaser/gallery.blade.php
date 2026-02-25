@if ($employee->orderedImages->count())
    @php
        $showButton = config("staff-pages.galleryButton");
        if (is_numeric($showButton)) {
            $showButton = $employee->orderedImages->count() > $showButton;
        }
    @endphp
    @if ($showButton)
        <div class="mt-indent-half" x-data="{ expanded: false }">
            <button type="button" @click="expanded = !expanded"
                    :class="expanded ? 'border-primary bg-white text-primary' : 'border-stroke bg-stroke/25 text-body/60'"
                    class="flex items-center justify-between h-10 w-full px-indent-xs border hover:border-primary rounded-base hover:bg-primary/10 hover:text-primary cursor-pointer transition-all">
            <span class="text-nowrap text-sm font-medium">
                {{ config("staff-pages.galleryBtnTitle") }}
            </span>
                <span class="transition-all" :class="expanded && 'rotate-180'">
                <x-tt::ico.arrow-down />
            </span>
            </button>

            <div x-collapse x-show="expanded" style="display: none"
                 class="flex flex-wrap items-center -mx-1.25">
                @foreach($employee->orderedImages as $image)
                    <a data-fslightbox="lightbox-{{ $employee->id }}"
                       href="{{ route("thumb-img", ["template" => "original", "filename" => $image->filename]) }}"
                       class="px-1.25 pt-indent-half">
                        <img src="{{ route("thumb-img", ["template" => "employee-gallery-teaser", "filename" => $image->filename]) }}"
                             alt="" class="rounded-base">
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="mt-indent-half flex flex-wrap items-center -mx-1.25">
            @foreach($employee->orderedImages as $image)
                <a data-fslightbox="lightbox-{{ $employee->id }}"
                   href="{{ route("thumb-img", ["template" => "original", "filename" => $image->filename]) }}"
                   class="px-1.25 pt-indent-half">
                    <img src="{{ route("thumb-img", ["template" => "employee-gallery-teaser", "filename" => $image->filename]) }}"
                         alt="" class="rounded-base">
                </a>
            @endforeach
        </div>
    @endif
@endif
