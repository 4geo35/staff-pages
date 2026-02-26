<div class="flex flex-nowrap">
    <div class="space-y-indent-half w-1/2 xs:w-auto">
        <div class="w-full xs:w-[196px] xs:h-[235px]">
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

    <div class="flex-auto sm:hidden ml-indent-half w-1/2">
        @if (!$isFullPage)
            <div class="text-h4-mobile font-medium sm:hidden">{{ $employee->fio }}</div>
        @endif

        @if ($employee->activeDepartments->count())
            <ul class="flex flex-wrap">
                @foreach($employee->activeDepartments as $departmentItem)
                    <x-sp::department.list-item :$isFullPage :slug="$departmentItem->slug">
                        {{ $departmentItem->title }}
                    </x-sp::department.list-item>
                @endforeach
            </ul>
        @endif

        @if ($employee->comment)
            <div class="hidden xs:block prose max-w-none mt-indent-half">
                {!! $employee->comment_markdown !!}
            </div>
        @endif
    </div>
</div>
