<div class="card">
    <div class="card-body">
        <div class="space-y-indent-half">
            @include("sp::admin.departments.includes.search")
            <x-tt::notifications.error />
            <x-tt::notifications.success />
        </div>
    </div>
    @include("sp::admin.departments.includes.table")
    @include("sp::admin.departments.includes.table-modals")
    @include("sp::admin.departments.includes.order-modal")
</div>
