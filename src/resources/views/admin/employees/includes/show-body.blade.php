<div class="row">
    <div class="col w-full md:w-1/2 mb-indent-half md:mb-0 flex flex-col gap-indent-half">
        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">Адресная строка</h3>
            </div>
            <div class="col w-full xs:w-3/5">{{ $employee->slug }}</div>
        </div>

        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">{{ config("staff-pages.employeeShort") }}</h3>
            </div>
            <div class="col w-full xs:w-3/5">{{ $employee->short }}</div>
        </div>

        @if (config("staff-pages.useEnableBtn"))
            <div class="row">
                <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                    <h3 class="font-semibold">{{ config("staff-pages.employeeEnableBtn") }}</h3>
                </div>
                <div class="col w-full xs:w-3/5">{{ $employee->enable_btn ? "Да" : "Нет" }}</div>
            </div>
        @endif

        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">{{ config("staff-pages.departmentPageTitle") }}</h3>
            </div>
            <div class="col w-full xs:w-3/5">
                <ul>
                    @foreach($employee->orderedDepartments as $department)
                        <li>
                            <a href="{{ route('admin.departments.show', compact('department')) }}"
                               class="text-primary hover:text-primary-hover">
                                {{ $department->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col w-full md:w-1/2 mb-indent-half md:mb-0 flex flex-col gap-indent-half">
        <div class="row">
            <div class="col w-full mb-indent-half">
                <h3 class="font-semibold">{{ config("staff-pages.employeeDescription") }}</h3>
            </div>
            <div class="col w-full">
                <div class="prose max-w-none">
                    {!! $employee->markdown !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col w-full mb-indent-half">
                <h3 class="font-semibold">{{ config("staff-pages.employeeComment") }}</h3>
            </div>
            <div class="col w-full">
                <div class="prose max-w-none">
                    {!! $employee->comment_markdown !!}
                </div>
            </div>
        </div>
    </div>
</div>
