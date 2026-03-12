<x-app-layout>
    @include("sp::web.employees.includes.department-metas")
    @include("sp::web.employees.includes.department-breadcrumbs")
    @include("sp::web.employees.includes.department-h1")

    <livewire:sp-web-employee-index :$department />

    @if (config("staff-pages.useEnableBtn") && config("staff-pages.useAvailableForms"))
        @push("modals")
            <livewire:sp-web-employee-form />
        @endpush
    @endif
</x-app-layout>
