<x-admin-layout>
    <x-slot name="title">
        {{ config("staff-pages.availableForms.employee-request.title") ?? "Записаться на прием" }}
    </x-slot>
    <x-slot name="pageTitle">
        {{ config("staff-pages.availableForms.employee-request.title") ?? "Записаться на прием" }}
    </x-slot>

    <livewire:sp-admin-employee-form-table />
</x-admin-layout>
