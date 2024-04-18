@props([
    'disabled' => false,
    'name' => '',
    'id'
])

<div {{$attributes->merge(['class' => 'tw-w-full tw-flex tw-flex-col tw-relative tw-group'])}}><select {{ $disabled ? 'disabled' : ''}} class="{{ $disabled ? 'tw-input-disabled tw-placeholder tw-appearance-none tw-bg-b50' : 'tw-input-enabled tw-placeholder tw-appearance-none tw-bg-b50' }}" id="{{ isset($id) ? $id : $name }}" name="{{$name}}">{{$slot}}</select><span class="toggleDrop tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2"><img id="arrowDown" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"alt="\/"></span></div>

