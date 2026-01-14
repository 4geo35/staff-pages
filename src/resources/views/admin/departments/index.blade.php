<x-admin-layout>
    <x-slot name="title">{{ config("staff-pages.departmentPageTitle") }}</x-slot>
    <x-slot name="pageTitle">{{ config("staff-pages.departmentPageTitle") }}</x-slot>

    <livewire:sp-admin-department-index />
</x-admin-layout>
