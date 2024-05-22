@props([
    'disabled' => false,
    'name' => '',
    'id' => '',
    'placeholder' => '',
    'searchable' => '',
    'gap' => 'tw-top-20',
    'default'
])

<button type="button" id="{{ $name }}-list" name="{{ $name }}"
    class="dropdownTrigger tw-cursor-pointer tw-input-enabled tw-flex tw-items-center tw-justify-between">
    <span class="tw-line-clamp-1">{{isset($default) ? $default : $placeholder}}</span>
    <x-icons.actionable.arrow-down-1 stroke="1.5" color="n1000"></x-icons.actionable.arrow-down-1>
</button>
<x-input.input value="{{isset($default) ? ($default != $placeholder ? $default : '' ) : ''}}" type="hidden" placeholder="{{$placeholder}}" name="{{ $name }}"
    id="{{ $name }}"></x-input.input>
<div
    class="dropContent tw-hidden tw-absolute tw-flex tw-flex-col tw-gap-3 {{$gap}} tw-z-10 tw-p-3 tw-w-full tw-bg-n100 tw-rounded-lg tw-border-[1.5px] tw-border-n400">
    @if ($searchable)
        <x-input.leadicon type="text" name="searchDropItem">
            <x-icons.actionable.search color="n1000" size="20" stroke="2"></x-icons.actionable.search>
        </x-input.leadicon>
    @endif
    <ul class="dropItems tw-w-f ull tw-overflow-y-auto tw-max-h-40">
        {{-- <li class="dropdownItem tw-flex tw-items-center tw-h-10 hover:tw-bg-n300 tw-p-2 tw-placeholder">COBA</li> --}}
        {{-- <x-input.dropdown-item item='Pelajar/Mahasiswa'></x-input.dropdown-item>
                                        <x-input.dropdown-item item='Pelajar/Mahasiswa'></x-input.dropdown-item>
                                        <x-input.dropdown-item item='Pelajar/Mahasiswa'></x-input.dropdown-item> --}}
    </ul>
</div>
