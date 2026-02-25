<div class="mt-indent-half">
    @if (config("staff-pages.useEnableBtn") && $employee->enable_btn)
        <button type="button" class="btn btn-primary w-full sm:w-auto" x-data
                @click="$dispatch('show-employee-form', { key: 'employee-request', employeeFio: '{{ $employee->fio }}' })">
            {{ config("staff-pages.modalBtnTitle") }}
        </button>
    @endif
</div>
