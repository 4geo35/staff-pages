@if (config("staff-pages.useH1"))
    <div class="container">
        <x-tt::h1 class="mb-indent">{{ config("staff-pages.employeePageTitle") }}</x-tt::h1>
    </div>
@endif
