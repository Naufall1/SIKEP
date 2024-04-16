<!-- /resources/views/components/input/group.blade.php -->

@props([
    'for' => '',
    'label' => ''
])

<label
    {{ $attributes->merge(['class' => 'tw-label tw-flex tw-flex-col tw-gap-2']) }}
    for="{{ $for }}" > {{ $label }}
    
    {{$slot}}

</label>