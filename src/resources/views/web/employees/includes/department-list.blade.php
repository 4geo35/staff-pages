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
