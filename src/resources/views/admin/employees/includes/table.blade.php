<x-tt::table>
    <x-slot name="head">
        <tr>
            <x-tt::table.heading class="text-left">ФИО</x-tt::table.heading>
            <x-tt::table.heading class="text-left">Адресная строка</x-tt::table.heading>
            <x-tt::table.heading class="text-left">{{ config("staff-pages.departmentPageTitle") }}</x-tt::table.heading>
            @if (config("staff-pages.useEnableBtn"))
                <x-tt::table.heading class="text-left text-nowrap">{{ config("staff-pages.employeeEnableBtn") }}</x-tt::table.heading>
            @endif
            <x-tt::table.heading>Действия</x-tt::table.heading>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($employees as $item)
            <tr>
                <td>{{ $item->fio }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                    <ul>
                        @foreach($item->orderedDepartments as $department)
                            <li>
                                <a href="{{ route('admin.departments.show', compact('department')) }}"
                                   class="text-primary hover:text-primary-hover">
                                    {{ $department->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </td>
                @if (config("staff-pages.useEnableBtn"))
                    <td>{{ $item->enable_btn ? "Да" : "Нет" }}</td>
                @endif
                <td>
                    <div class="flex items-center justify-center">
                        @if ($item->image_id)
                            <a href="{{ route('thumb-img', ['filename' => $item->image->filename, 'template' => 'original']) }}"
                               class="btn btn-primary px-btn-x-ico mr-indent-half" target="_blank">
                                <x-tt::ico.image />
                            </a>
                        @endif

                        @can("viewAny", $item::class)
                            <a href="{{ route('admin.employees.show', ['employee' => $item]) }}"
                               class="btn btn-primary px-btn-ico-text rounded-e-none">
                                <x-tt::ico.eye />
                            </a>
                        @else
                            <button type="button" class="btn btn-primary px-btn-x-ico rounded-e-none" disabled>
                                <x-tt::ico.eye />
                            </button>
                        @endcan
                        <button type="button" class="btn btn-dark px-btn-x-ico rounded-none"
                                @cannot("update", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="showEdit({{ $item->id }})">
                            <x-tt::ico.edit />
                        </button>
                        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                @cannot("delete", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="showDelete({{ $item->id }})">
                            <x-tt::ico.trash />
                        </button>

                        <button type="button" class="btn {{ $item->published_at ? 'btn-success' : 'btn-danger' }} px-btn-x-ico ml-indent-half"
                                @cannot("update", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="switchPublish({{ $item->id }})">
                            @if ($item->published_at)
                                <x-tt::ico.toggle-on />
                            @else
                                <x-tt::ico.toggle-off />
                            @endif
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-tt::table>
