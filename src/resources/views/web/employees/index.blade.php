<x-app-layout>
    @include("sp::web.employees.includes.metas")
    @include("sp::web.employees.includes.breadcrumbs")
    @include("sp::web.employees.includes.h1")

    <livewire:sp-web-employee-index />
    @push("modals")
        <livewire:sp-web-employee-form />
    @endpush
</x-app-layout>
