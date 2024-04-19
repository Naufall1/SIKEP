@props([
    'disabled' => false,
    'name' => '',
    'value' => '',
    'placeholder' => '',
])

<textarea {{ $disabled ? 'disabled' : ''}} {{ $disabled ? $attributes->merge(['class' => 'tw-input-disabled tw-pt-[9px] tw-placeholder']) : $attributes->merge(['class' => 'tw-input-enabled tw-pt-[9px] tw-placeholder']) }} id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}" value="">{{$value}}</textarea>