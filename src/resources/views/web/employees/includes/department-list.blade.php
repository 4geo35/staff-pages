@if ($departmentList && $departmentList->count())
    <div class="flex flex-wrap px-indent-xs pt-indent-xs mb-indent-lg rounded-base bg-white">
        @foreach($departmentList as $departmentItem)
            <label for="department-{{ $departmentItem->slug }}"
                   class="btn btn-sm not-checked:btn-outline-secondary has-checked:btn-secondary mr-indent-xs mb-indent-xs has-disabled:opacity-25">
                {{ $departmentItem->title }}
                <input type="checkbox" value="{{ $departmentItem->slug }}"
                       id="department-{{ $departmentItem->slug }}" class="hidden"
                       wire:model.live="searchDepartment" wire:loading.attr="disabled" />
            </label>
        @endforeach
    </div>
@endif
