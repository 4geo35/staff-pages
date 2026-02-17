@props(["employee", "onFullPage" => false])
@php($hasImage = (bool) $employee->image_id)
<div class="h-full bg-white px-indent pt-indent rounded-base">
    <div class="row">
        <div class="col w-full {{ $onFullPage ? 'md:w-1/2' : '' }} mb-indent">
            <div class="flex items-start flex-nowrap space-x-indent">
                @include("sp::web.employees.teaser.top-left")
                @include("sp::web.employees.teaser.top-right")
            </div>
        </div>
        <div class="col w-full {{ $onFullPage ? 'md:w-1/2' : '' }} mb-indent">
            @if ($employee->description)
                <div class="prose max-w-none">
                    {!! $employee->markdown !!}
                </div>
            @endif
        </div>
    </div>
</div>
