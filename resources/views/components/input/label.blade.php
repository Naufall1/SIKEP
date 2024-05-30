@props([
    'required' => false,
    'for' => '',
    'label' => ''
])

<label {{$attributes->merge(['class' => 'tw-label tw-flex tw-flex-col tw-gap-2']) }} for="{{ $for }}" ><span class="{{$required ? 'required-label' : ''}}">{{$label}}</span>{{$slot}}</label>