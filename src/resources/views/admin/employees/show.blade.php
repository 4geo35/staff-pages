<x-admin-layout>
    <x-slot name="title">Просмотр сотрудника</x-slot>
    <x-slot name="pageTitle">Просмотр сотрудника</x-slot>

    <div class="space-y-indent-half">
        <livewire:sp-admin-employee-show :$employee />
        @includeIf("sd::admin.doctors.card", compact("employee"))
        <livewire:fa-images :model="$employee" />
        <livewire:ma-metas :model="$employee" />
    </div>
</x-admin-layout>
