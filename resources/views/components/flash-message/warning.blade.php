@props([
    'message', 
])

<div {{$attributes->merge(['class' => 'message tw-bg-y50 tw-border-y500 tw-border-[1.5px] tw-flex tw-p-4 tw-w-full tw-justify-between tw-items-center tw-rounded-md'])}}>
    <div class="tw-flex tw-items-center tw-gap-2">
        <x-icons.information.warning class="tw-stroke-y500" stroke="1.5" size="32"
        color="y500"></x-icons.information.warning>
        <h3 class="tw-text-y500 tw-font-semibold">{{$message}}</h3>
    </div>
    {{-- <x-icons.actionable.close id="closeFlash" class="tw-cursor-pointer" stroke="2" size="24"
            color="n600"></x-icons.actionable.close> --}}
</div>