<div class="w-full sm:w-auto sm:flex-auto">
    @if (!$isFullPage) <x-tt::h4 class="hidden sm:block">{{ $employee->fio }}</x-tt::h4> @endif

    @if ($employee->departments->count())
        <ul class="hidden sm:flex flex-wrap">
            @foreach($employee->activeDepartments as $departmentItem)
                <x-sp::department.list-item :$isFullPage :department="$departmentItem">
                    {{ $departmentItem->title }}
                </x-sp::department.list-item>
            @endforeach
        </ul>
    @endif

    @if ($employee->comment)
        <div class="xs:hidden sm:block prose max-w-none mt-indent-half">
            {!! $employee->comment_markdown !!}
        </div>
    @endif

    @include("sp::web.employees.teaser.gallery")

    @if (!$isFullPage)
        @include("sp::web.employees.teaser.buttons")
    @elseif(!empty($anchor))
        <a href="#{{ $anchor }}" class="btn btn-primary w-full md:w-auto mt-indent-half sm:mr-indent-xs">
            {{ config("staff-pages.anchorBtnTitle") }}
        </a>
    @endif
</div>
