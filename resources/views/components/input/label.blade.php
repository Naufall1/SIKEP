@props([
    'required' => false,
    'edited' => false,
    'for' => '',
    'label' => ''
])

<label {{$attributes->merge(['class' => 'tw-label tw-flex tw-flex-col tw-gap-2']) }} for="{{ $for }}" ><span class="{{(empty($label) ? 'tw-hidden' : ($required ? 'required-label' : ($edited ? 'onEdit-label' : '')))}}">{{$label}}</span>{{$slot}}</label>