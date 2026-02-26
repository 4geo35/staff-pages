@props(["employee", "onFullPage" => false, "isFullPage" => false])
@php($hasImage = (bool) $employee->image_id)
<div class="h-full bg-white px-indent-half sm:px-indent pt-indent-half sm:pt-indent rounded-base">
    <div class="row">
        <div class="col w-full {{ $onFullPage ? 'xl:w-1/2' : '' }} mb-indent">
            <div class="flex items-start flex-col sm:flex-row flex-nowrap sm:space-x-indent">
                @include("sp::web.employees.teaser.top-left")
                @include("sp::web.employees.teaser.top-right")
            </div>
        </div>
        <div class="col w-full {{ $onFullPage ? 'xl:w-1/2' : '' }} mb-indent-half sm:mb-indent">
            @if ($employee->description)
                <div class="prose max-w-none">
                    {!! $employee->markdown !!}
                </div>
            @endif
        </div>
    </div>
</div>
