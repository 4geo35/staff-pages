<div class="container">
    @include("sp::web.employees.includes.department-list")

    <div class="row">
        @php($isFullCol = config("staff-pages.fullCol"))
        @foreach($employees as $employee)
            <div class="col w-full {{ $isFullCol ? '' : 'xl:w-1/2' }} mb-indent">
                <x-sp::employee.teaser :$employee :on-full-page="$isFullCol" />
            </div>
        @endforeach
    </div>
</div>
