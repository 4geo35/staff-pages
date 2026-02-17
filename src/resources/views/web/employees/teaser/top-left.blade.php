<div class="space-y-indent-half">
    <div class="w-[196px] h-[235px]">
        @if ($hasImage)
            <picture>
                <img src="{{ route("thumb-img", ["template" => "employee-teaser", "filename" => $employee->image->filename]) }}"
                     alt="" class="rounded-base">
            </picture>
        @else
            <div class="flex items-center justify-center h-full w-full rounded-base border border-stroke text-secondary">
                <x-sp::ico.person width="150" height="150" />
            </div>
        @endif
    </div>
    @if (!empty($employee->short))
        <div class="text-sm text-body/60">{{ $employee->short }}</div>
    @endif
</div>
