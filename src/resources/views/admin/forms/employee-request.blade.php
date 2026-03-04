<x-admin-layout>
    <x-slot name="title">
        {{ config("staff-pages.availableForms.employee-request.title") ?? "Записаться на прием" }}
    </x-slot>
    <x-slot name="pageTitle">
        {{ config("staff-pages.availableForms.employee-request.title") ?? "Записаться на прием" }}
    </x-slot>

    @if (config("staff-doctors"))
        @includeIf("sd::admin.forms.offer-request-component")
    @else
        <livewire:sp-admin-employee-form-table />
    @endif
</x-admin-layout>
