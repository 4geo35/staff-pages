<div class="container">
    @if ($departmentList && $departmentList->count())
        <div class="flex flex-wrap px-indent-xs pt-indent-xs mb-indent-lg rounded-base bg-white">
            @foreach($departmentList as $departmentItem)
                <button type="button"
                        class="btn btn-sm btn-outline-secondary mr-indent-xs mb-indent-xs">
                    {{ $departmentItem->title }}
                </button>
            @endforeach
        </div>
    @endif

    <div class="row">
        @php($isFullCol = config("staff-pages.fullCol"))
        @foreach($employees as $employee)
            <div class="col w-full {{ $isFullCol ? '' : 'md:w-1/2' }} mb-indent">
                <x-sp::employee.teaser :$employee :on-full-page="$isFullCol" />
            </div>
        @endforeach
    </div>
</div>
