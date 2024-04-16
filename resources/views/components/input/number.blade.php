@props([
    'disabled' => false,
    'name' => '',
    'value' => '',
    'placeholder' => '',
])

<input {{ $disabled ? 'disabled' : ''}} {{ $disabled ? $attributes->merge(['class' => 'tw-input-disabled tw-placeholder']) : $attributes->merge(['class' => 'tw-input-enabled tw-placeholder']) }} type="text" id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}" value="{{$value}}">