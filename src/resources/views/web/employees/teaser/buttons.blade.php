<div class="flex items-start justify-start flex-wrap">
    @if (config("staff-pages.useEnableBtn") && config("staff-pages.useAvailableForms") && $employee->enable_btn)
        <button type="button" class="btn btn-primary w-full md:w-auto mt-indent-half sm:mr-indent-xs" x-data
                @click="$dispatch('show-employee-form', { key: 'employee-request', employeeFio: '{{ $employee->fio }}' })">
            {{ config("staff-pages.modalBtnTitle") }}
        </button>
    @endif
    @includeIf("sd::web.employees.teaser-btn")
</div>
