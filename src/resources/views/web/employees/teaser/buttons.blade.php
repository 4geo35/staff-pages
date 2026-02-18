<div class="mt-indent-half">
    <button type="button" class="btn btn-primary" x-data
            @click="$dispatch('show-employee-form', { key: 'employee-request', employeeFio: '{{ $employee->fio }}' })">
        {{ config("staff-pages.modalBtnTitle") }}
    </button>
</div>
