@props([
    'url', 'title', 'value', 
])
<a href="{{$url}}" {{$attributes->merge(['class' => 'previewCount tw-grow tw-flex tw-flex-col tw-h-32 tw-bg-n100 tw-group'])}}>
    <div
        class="tw-h-4/6 tw-w-full tw-px-4 tw-border-[1.5px] tw-rounded-t-md tw-flex tw-flex-col tw-gap-1 tw-items-start tw-justify-center tw-cursor-pointer">
        <h4 class="tw-placeholder tw-text-n600">{{$title}}</h4>
        <h2 class="tw-text-n1000">{{$value}}</h2>
    </div>
    <div 
        class="tw-top-menu-text tw-text-n1000 tw-grow tw-w-full tw-px-4 tw-border-[1.5px] tw-border-t-0 tw-rounded-b-md tw-flex tw-items-center tw-justify-between group-hover:tw-bg-b500 group-hover:tw-text-n100 group-hover:tw-border-b500">
        Lihat
        <x-icons.actionable.arrow-right class="group-hover:tw-stroke-n100" stroke="2" size="20"
            color="n1000"></x-icons.actionable.arrow-right>
    </div>
</a>