@if ($departmentList && $departmentList->count())
    <div class="flex flex-wrap px-indent-xs pt-indent-xs mb-indent-lg rounded-base bg-white">
        @foreach($departmentList as $departmentItem)
            <a href="{{ route('web.employees.department', ['department' => $departmentItem]) }}"
               class="btn btn-sm {{ ! empty($department) && $department->id === $departmentItem->id ? "btn-secondary" : "btn-outline-secondary" }} mr-indent-xs mb-indent-xs">
                {{ $departmentItem->title }}
            </a>
        @endforeach
    </div>
@endif
