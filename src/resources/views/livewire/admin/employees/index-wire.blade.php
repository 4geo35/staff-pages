<div class="card">
    <div class="card-body">
        <div class="space-y-indent-half">
            @include("sp::admin.employees.includes.search")
            <x-tt::notifications.error />
            <x-tt::notifications.success />
        </div>
    </div>
    @include("sp::admin.employees.includes.table")
    @include("sp::admin.employees.includes.table-modals")
    @include("sp::admin.employees.includes.order-modal")
</div>
