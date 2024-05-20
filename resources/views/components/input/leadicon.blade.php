@props([
    'disabled' => false,
    'name' => '',
    'value' => '',
    'type' => '',
    'placeholder' => '',
    'icon' => '',
    'alt' => '',
])

<div class="tw-relative tw-flex tw-w-full">
    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}"
    value="{{$value}}" {{ $disabled ? 'disabled' : ''}} {{ $disabled ? $attributes->merge(['class' => 'tw-input-disabled tw-placeholder  tw-pl-8 tw-pr-3']) : $attributes->merge(['class' => 'tw-input-enabled tw-placeholder  tw-pl-8 tw-pr-3']) }} type="{{$type}}" {{$type === 'number' ? 'min=0' : ''}}>
    </input>
    <span
        class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-cursor-pointer">
        {{$slot}}
    </span>
</div>