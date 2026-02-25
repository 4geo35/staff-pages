<x-app-layout>
    @include("sp::web.employees.includes.metas")
    @include("sp::web.employees.includes.breadcrumbs")
    @include("sp::web.employees.includes.h1")

    <livewire:sp-web-employee-index />

    @if (config("staff-pages.useEnableBtn"))
        @push("modals")
            <livewire:sp-web-employee-form />
        @endpush
    @endif
</x-app-layout>
