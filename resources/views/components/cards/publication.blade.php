@props([
    'url', 'image', 'type', 'title', 'writer', 'date'
])

<a href="{{$url}}" class='tw-grow tw-flex tw-flex-col tw-h-[404px] tw-col-span-6 md:tw-col-span-3 lg:tw-col-span-2 tw-bg-n100 tw-group'>
    <div class="tw-h-52 tw-rounded-t-md tw-border-[1.5px] tw-border-b-0 tw-border-n400 tw-overflow-hidden">
        <img class="" src="{{ asset('assets/landing/'. $image .'.jpg') }}" alt="">
    </div>
    <div
        class="tw-grow tw-w-full tw-px-4 tw-border-[1.5px] tw-flex tw-flex-col tw-gap-2 tw-items-start tw-justify-center tw-cursor-pointer">
        <x-form.iconlabel content="{{$type}}"></x-form.iconlabel>
        <div class="tw-flex tw-flex-col tw-gap-2">
            <h2 class="tw-text-wrap tw-line-clamp-2">{{$title}}</h2>
            <div class="tw-flex tw-gap-1 tw-items-center">
                <p class="tw-caption tw-w-fit tw-text-n1000 tw-line-clamp-1">{{$writer}}</p>
                <div class="tw-h-[6px] tw-w-[6px] tw-rounded-full tw-bg-n600"></div>
                <p class="tw-caption tw-w-fit tw-text-n1000 tw-line-clamp-1">{{$date}}</p>
            </div>
        </div>
    </div>
    <div
        class="tw-top-menu-text tw-text-b500 tw-h-11 tw-w-full tw-px-4 tw-border-[1.5px] tw-border-t-0 tw-rounded-b-md tw-flex tw-items-center tw-justify-between group-hover:tw-bg-b500 group-hover:tw-text-n100 group-hover:tw-border-b500">
        Baca
        <x-icons.actionable.arrow-right class="tw-stroke-n600 group-hover:tw-stroke-n100" stroke="2" size="20"
            color="n1000"></x-icons.actionable.arrow-right>
    </div>
</a>