@props([
    'disabled' => false,
    'name' => '',
    'id' => '',
    'placeholder' => 'Masukkan Kata Sandi',
])


<div {{ $attributes->merge(['class' => 'tw-w-full tw-flex tw-flex-col tw-relative tw-group']) }}>
    <input {{ $disabled ? 'disabled' : '' }}
        class="{{ $disabled ? 'tw-input-disabled tw-placeholder tw-appearance-none' : 'tw-input-enabled tw-placeholder tw-appearance-none' }}"
        type="password" id="{{ isset($id) ? $id : $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}">
    <span id=""
        class="togglePassword tw-stroke-n1000 tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2 tw-cursor-pointer">
        {{-- <img id="eyeIcon" src="{{ asset('assets/icons/actionable/eye.svg') }}" alt="eye"> --}}
        {{-- <x-icons.actionable.eye color="n1000" stroke="1.5" id="eyeIcon"></x-icons.actionable.eye> --}}
        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16.227 12C16.227 13.98 14.627 15.58 12.647 15.58C10.667 15.58 9.06703 13.98 9.06703 12C9.06703 10.02 10.667 8.42 12.647 8.42C14.627 8.42 16.227 10.02 16.227 12Z"
                stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M12.647 20.27C16.177 20.27 19.467 18.19 21.757 14.59C22.657 13.18 22.657 10.81 21.757 9.4C19.467 5.8 16.177 3.72 12.647 3.72C9.11703 3.72 5.82703 5.8 3.53703 9.4C2.63703 10.81 2.63703 13.18 3.53703 14.59C5.82703 18.19 9.11703 20.27 12.647 20.27Z"
                stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>
</div>
