@props(["employees", "title"])
<div {{ $attributes->merge(["class" => ""]) }}>
    <div class="flex items-end justify-between space-x-indent-double mb-indent">
        <x-tt::h2>{{ $title }}</x-tt::h2>
        <a href="{{ route('web.employees.index') }}" class="btn btn-outline-primary hidden lg:inline-flex">
            Посмотреть всех
        </a>
    </div>
    <div class="row">
        @php($hideLast = $employees->count() > 3)
        @foreach($employees as $employee)
            <div class="col w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 mb-indent {{ $hideLast ? 'lg:last-of-type:hidden last-of-type:xl:block' : '' }}">
                <x-sp::employee.home-teaser :$employee />
            </div>
        @endforeach
    </div>
    <div class="flex items-center justify-end lg:hidden">
        <a href="{{ route('web.employees.index') }}" class="btn btn-outline-primary w-full sm:w-auto">
            Посмотреть всех
        </a>
    </div>

    @if (config("staff-pages.useEnableBtn") && config("staff-pages.useAvailableForms"))
        @push("modals")
            <livewire:sp-web-employee-form
                prefix="employees-home-block"
                postfix="employees-home-block" />
        @endpush
    @endif
</div>
