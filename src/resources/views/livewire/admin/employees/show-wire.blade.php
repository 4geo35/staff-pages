<div>
    <div class="card">
        <div class="card-header">
            <div class="space-y-indent-half">
                @include("sp::admin.employees.includes.show-title")
                <x-tt::notifications.error />
                <x-tt::notifications.success />
            </div>
        </div>
        <div class="card-body">
            @include("sp::admin.employees.includes.show-body")
        </div>
    </div>

    @include("sp::admin.employees.includes.table-modals")
</div>
