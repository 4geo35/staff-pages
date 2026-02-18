<div class="flex-auto">
    <x-tt::h4 class="">{{ $employee->fio }}</x-tt::h4>

    @if ($employee->departments->count())
        <ul class="flex flex-wrap">
            @foreach($employee->departments as $departmentItem)
                <li class="flex flex-nowrap items-center justify-center h-7.5 px-indent-xs text-sm text-nowrap font-medium rounded-base bg-light mr-indent-xs mt-indent-half">
                    {{ $departmentItem->title }}
                </li>
            @endforeach
        </ul>
    @endif

    @if ($employee->comment)
        <div class="prose max-w-none mt-indent-half">
            {!! $employee->comment_markdown !!}
        </div>
    @endif

    @include("sp::web.employees.teaser.gallery")
</div>
