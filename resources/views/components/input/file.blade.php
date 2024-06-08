@props([
    'disabled' => false,
    'name' => '',
    'id' => '',
    'accept' => '',
])

<div {{ $attributes->merge(['class' => 'tw-relative tw-cursor-pointer tw-input-enabled']) }}><input {{ $disabled ? 'disabled' : '' }} id="{{ isset($id) ? $id : $name }}" accept="{{ $accept ?? '' }}" name="{{ $name }}" type="file"class=" tw-flex tw-w-3/4 tw-grow tw-py-[9px] file:tw-absolute file:tw-top-1/2 file:-tw-translate-y-1/2 file:tw-right-0 file:tw-h-full file:tw-border-y-0 file: file:tw-border-r-0 file:tw-border-l-[1.5px] file:tw-rounded-r-md file:tw-px-2 file:hover:tw-bg-n200 file:hover:tw-border-n600 file:active:tw-border-n600 file:tw-justify-center tw-cursor-pointer file:tw-cursor-pointer  file:tw-border-n400 file:tw-bg-n100 file:tw-m-0"></div>
