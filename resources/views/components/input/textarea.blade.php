@props([
    'disabled' => false,
    'name' => '',
    'value' => '',
    'placeholder' => '',
])

<textarea {{ $disabled ? 'disabled' : ''}} {{ $disabled ? $attributes->merge(['class' => 'tw-input-disabled tw-pt-[9px] tw-placeholder tw-h-20']) : $attributes->merge(['class' => 'tw-input-enabled tw-pt-[9px] tw-placeholder tw-h-20']) }} id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}" value="">{{$value}}</textarea>