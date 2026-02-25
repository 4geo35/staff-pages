<div class="w-full sm:w-auto sm:flex-auto">
    <x-tt::h4 class="hidden sm:block">{{ $employee->fio }}</x-tt::h4>

    @if ($employee->departments->count())
        <ul class="hidden sm:flex flex-wrap">
            @foreach($employee->departments as $departmentItem)
                <x-sp::department.list-item>{{ $departmentItem->title }}</x-sp::department.list-item>
            @endforeach
        </ul>
    @endif

    @if ($employee->comment)
        <div class="xs:hidden sm:block prose max-w-none mt-indent-half">
            {!! $employee->comment_markdown !!}
        </div>
    @endif

    @include("sp::web.employees.teaser.gallery")

    @include("sp::web.employees.teaser.buttons")
</div>
