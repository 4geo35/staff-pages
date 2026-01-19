<x-admin-layout>
    <x-slot name="title">{{ config("staff-pages.employeePageTitle") }}</x-slot>
    <x-slot name="pageTitle">{{ config("staff-pages.employeePageTitle") }}</x-slot>

    <livewire:sp-admin-employee-index />
</x-admin-layout>
