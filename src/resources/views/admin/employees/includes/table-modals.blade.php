<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">Удалить сотрудника</x-slot>
    <x-slot name="text">Будет невозможно восстановить сотрудника</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.dialog wire:model="displayData">
    <x-slot name="title">{{ $employeeId ? "Редактировать сотрудника" : "Добавить сотрудника" }}</x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $employeeId ? 'update' : 'store' }}" class="space-y-indent-half"
              id="employeeDataForm">

            <div>
                <label for="lastName" class="inline-block mb-2">
                    Фамилия<span class="text-danger">*</span>
                </label>
                <input type="text" id="lastName"
                       class="form-control {{ $errors->has("lastName") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="lastName">
                <x-tt::form.error name="lastName"/>
            </div>

            <div>
                <label for="name" class="inline-block mb-2">
                    Имя<span class="text-danger">*</span>
                </label>
                <input type="text" id="name"
                       class="form-control {{ $errors->has("name") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="name">
                <x-tt::form.error name="name"/>
            </div>

            <div>
                <label for="patronymic" class="inline-block mb-2">
                    Отчество
                </label>
                <input type="text" id="patronymic"
                       class="form-control {{ $errors->has("patronymic") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="patronymic">
                <x-tt::form.error name="patronymic"/>
            </div>

            <div>
                <label for="slug" class="inline-block mb-2">
                    Адресная строка
                </label>
                <input type="text" id="slug"
                       class="form-control {{ $errors->has("slug") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="slug">
                <x-tt::form.error name="slug"/>
            </div>

            <div>
                <label for="cover" class="inline-block mb-2">Изображение</label>
                <input type="file" id="cover"
                       class="form-control {{ $errors->has('cover') ? 'border-danger' : '' }}"
                       wire:loading.attr="disabled"
                       wire:model.lazy="cover">
                <x-tt::form.error name="cover"/>
                @include("tt::admin.delete-image-button")
            </div>

            <div>
                <label for="short" class="inline-block mb-2">
                    {{ config("staff-pages.employeeShort") }}
                </label>
                <input type="text" id="short"
                       class="form-control {{ $errors->has("short") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="short">
                <x-tt::form.error name="short"/>
            </div>

            @if (config("staff-pages.useEnableBtn"))
                <div class="form-check">
                    <input type="checkbox" wire:model="enableBtn" id="enableBtn"
                           class="form-check-input {{ $errors->has('enableBtn') ? 'border-danger' : '' }}"/>
                    <label for="enableBtn" class="form-check-label">
                        {{ config("staff-pages.employeeEnableBtn") }}
                    </label>
                </div>
            @endif

            <div>
                <label for="description" class="flex justify-start items-center mb-2">
                    {{ config("staff-pages.employeeDescription") }}
                    @include("tt::admin.description-button")
                </label>
                @include("tt::admin.description-info")
                <textarea id="description"
                          class="form-control !min-h-52 {{ $errors->has('description') ? 'border-danger' : '' }}"
                          rows="10"
                          wire:model.live="description">
                        {{ $description }}
                    </textarea>
                <x-tt::form.error name="description"/>

                <div class="prose prose-sm mt-indent-half">
                    {!! \Illuminate\Support\Str::markdown($description) !!}
                </div>
            </div>

            <div>
                <label for="comment" class="flex justify-start items-center mb-2">
                    {{ config("staff-pages.employeeComment") }}
                    @include("tt::admin.description-button", ["id" => "hiddenCommentInfo"])
                </label>
                @include("tt::admin.description-info", ["id" => "hiddenCommentInfo"])
                <textarea id="comment"
                          class="form-control !min-h-52 {{ $errors->has('comment') ? 'border-danger' : '' }}"
                          rows="10"
                          wire:model.live="comment">
                        {{ $comment }}
                    </textarea>
                <x-tt::form.error name="comment"/>

                <div class="prose prose-sm mt-indent-half">
                    {!! \Illuminate\Support\Str::markdown($comment) !!}
                </div>
            </div>

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    Отмена
                </button>
                <button type="submit" form="employeeDataForm" class="btn btn-primary"
                        wire:loading.attr="disabled">
                    {{ $employeeId ? "Обновить" : "Добавить" }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.aside>
