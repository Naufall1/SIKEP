@props([])

<div {{$attributes->merge(['class' => 'tw-w-full'])}}>
    <div class="tw-p-4 tw-h-full tw-flex tw-flex-col tw-gap-4 tw-w-full md:tw-w-full tw-bg-n100 tw-border-[1.5px] tw-rounded-md">
        {{$slot}}
    </div>
</div>