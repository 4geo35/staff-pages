<div class="flex justify-between items-center overflow-x-auto beautify-scrollbar">
    <h2 class="font-medium text-2xl text-nowrap mr-indent-half">
        {{ $employee->fio }}
    </h2>

    <div class="flex justify-end">
        @if ($employee->image_id && $employee->image)
            <a href="{{ route('thumb-img', ['filename' => $employee->image->filename, 'template' => 'original']) }}"
               class="btn btn-primary px-btn-x-ico mr-indent-half" target="_blank">
                <x-tt::ico.image />
            </a>
        @endif

        <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                @cannot("update", $employee) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="showEdit({{ $employee->id }})">
            <x-tt::ico.edit />
        </button>
        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                @cannot("delete", $employee) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="showDelete({{ $employee->id }})">
            <x-tt::ico.trash />
        </button>

        <button type="button" class="btn {{ $employee->published_at ? 'btn-success' : 'btn-danger' }} px-btn-x-ico ml-indent-half"
                @cannot("update", $employee) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="switchPublish({{ $employee->id }})">
            @if ($employee->published_at)
                <x-tt::ico.toggle-on />
            @else
                <x-tt::ico.toggle-off />
            @endif
        </button>
    </div>
</div>
