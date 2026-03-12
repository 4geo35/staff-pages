@if (config("staff-pages.useH1"))
    <div class="container">
        @php
            $prefix = config("staff-pages.departmentPageH1Prefix");
            $h1 = $department->title;
            if (!empty($prefix)) { $h1 = "$prefix $h1"; }
        @endphp
        <x-tt::h1 class="mb-indent">{{ $h1 }}</x-tt::h1>
    </div>
@endif
