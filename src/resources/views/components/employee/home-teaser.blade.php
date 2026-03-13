@props(["employee"])
@php($hasImage = (bool) $employee->image_id)
<div class="flex flex-col h-full p-indent sm:p-indent-half 2xl:p-indent space-y-indent rounded-base bg-white">
    <div class="xs:h-[368px] sm:h-[210px] md:h-[280px] lg:h-[246px] xl:h-[230px] 2xl:h-[265px]">
        @if ($hasImage)
            <picture>
                <source media="(min-width: 1024px)"
                        srcset="{{ route('thumb-img', ['template' => "employee-home-teaser", 'filename' => $employee->image->filename]) }}">
                <source media="(min-width: 640px)"
                        srcset="{{ route('thumb-img', ['template' => "tablet-employee-home-teaser", 'filename' => $employee->image->filename]) }}">
                <img src="{{ route("thumb-img", ["template" => "mobile-employee-home-teaser", "filename" => $employee->image->filename]) }}"
                     alt="" class="rounded-base h-full object-cover object-center">
            </picture>
        @else
            <div class="flex items-center justify-center h-full w-full rounded-base border border-stroke text-secondary">
                <x-sp::ico.person width="150" height="150" />
            </div>
        @endif
    </div>
    <div class="flex-1 flex flex-col justify-between space-y-indent-sm">
        <div>
            <div class="text-h4-mobile sm:text-h4 font-semibold">{{ $employee->fio }}</div>
            @if (!empty($employee->short))
                <div class="text-sm text-body/60 mt-indent-xs">{{ $employee->short }}</div>
            @endif
            @if ($employee->activeDepartments->count())
                <ul class="flex flex-wrap">
                    @foreach($employee->activeDepartments as $departmentItem)
                        <x-sp::department.list-item :isFullPage="true" :department="$departmentItem">
                            {{ $departmentItem->title }}
                        </x-sp::department.list-item>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="space-y-indent-xs">
            @if (config("staff-pages.useEnableBtn") && config("staff-pages.useAvailableForms") && $employee->enable_btn)
                <button type="button" class="btn btn-primary w-full" x-data
                        @click="$dispatch('show-employee-form', { key: 'employee-request', employeeFio: '{{ $employee->fio }}' })">
                    {{ config("staff-pages.modalBtnTitle") }}
                </button>
            @endif
            @includeIf("sd::web.employees.home-teaser-btn")
        </div>
    </div>
</div>
