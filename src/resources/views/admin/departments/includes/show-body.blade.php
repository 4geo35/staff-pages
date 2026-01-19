<div class="row">
    <div class="col w-full md:w-1/2 mb-indent-half md:mb-0 flex flex-col gap-indent-half">
        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">Адресная строка</h3>
            </div>
            <div class="col w-full xs:w-3/5">{{ $department->slug }}</div>
        </div>

        @if($department->short)
            <div class="row">
                <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                    <h3 class="font-semibold">Краткое описание</h3>
                </div>
                <div class="col w-full xs:w-3/5">{{ $department->short }}</div>
            </div>
        @endif

        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">Сотрудники</h3>
            </div>
            <div class="col w-full xs:w-3/5">
                <ul>
                    @foreach($department->orderedEmployees as $employee)
                        <li>
                            <a href="{{ route('admin.employees.show', compact('employee')) }}"
                               class="text-primary hover:text-primary-hover">
                                {{ $employee->fio }}
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
                <h3 class="font-semibold">Описание</h3>
            </div>
            <div class="col w-full">
                <div class="prose max-w-none">
                    {!! $department->markdown !!}
                </div>
            </div>
        </div>
    </div>
</div>
