<x-admin-layout>
    <x-slot name="title">Просмотр отдела</x-slot>
    <x-slot name="pageTitle">Просмотр отдела</x-slot>

    <div class="space-y-indent-half">
        <livewire:sp-admin-department-show :$department />
        <livewire:ma-metas :model="$department" />
    </div>
</x-admin-layout>
