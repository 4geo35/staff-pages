@can("viewAny", config("staff-pages.customDepartmentModel") ?? \GIS\StaffPages\Models\EmployeeDepartment::class)
    <x-tt::admin-menu.item
        href="{{ route('admin.departments.index') }}"
        :active="in_array(Route::currentRouteName(), ['admin.departments.index', 'admin.departments.show'])">
        <x-slot name="ico"><x-sp::ico.work /></x-slot>
        {{ config("staff-pages.departmentPageTitle") }}
    </x-tt::admin-menu.item>
@endcan

@can("viewAny", config("staff-pages.customEmployeeModel") ?? \GIS\StaffPages\Models\Employee::class)
    <x-tt::admin-menu.item
        href="{{ route('admin.employees.index') }}"
        :active="in_array(Route::currentRouteName(), ['admin.employees.index', 'admin.employees.show'])">
        <x-slot name="ico"><x-sp::ico.badge /></x-slot>
        {{ config("staff-pages.employeePageTitle") }}
    </x-tt::admin-menu.item>
@endcan
