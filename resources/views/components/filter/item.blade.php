@props([
    'id'
])
<button id="{{$id}}"
    class="filterItem tw-col-span-2 sm:tw-col-span-1 tw-flex tw-items-center tw-rounded-full tw-justify-center tw-w-grow tw-h-10 tw-border-[1.5px] tw-text-sm tw-font-medium tw-filter-default">
    {{$slot}}
</button>