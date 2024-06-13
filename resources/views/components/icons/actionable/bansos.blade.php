@props([
    'active' => false,
    'size',
    'stroke' => 2,
])

<span {{$active ? $attributes->merge(['class'=>'tw-stroke-n100']) : $attributes->merge(['class'=>'tw-stroke-n700']) }}>  
    <svg width="{{ isset($size) ? $size : 25}}" height="{{ isset($size) ? $size : 24}}"  viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3.81705 7.44L12.647 12.55L21.417 7.47" stroke-width="{{$stroke}}" stroke-linecap="round"
            stroke-linejoin="round" />
        <path d="M12.647 21.61V12.54" stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M10.577 2.48001L5.23705 5.44001C4.02705 6.11001 3.03705 7.79001 3.03705 9.17001V14.82C3.03705 16.2 4.02705 17.88 5.23705 18.55L10.577 21.52C11.717 22.15 13.587 22.15 14.727 21.52L20.067 18.55C21.277 17.88 22.267 16.2 22.267 14.82V9.17001C22.267 7.79001 21.277 6.11001 20.067 5.44001L14.727 2.47001C13.577 1.84001 11.717 1.84001 10.577 2.48001Z"
            stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</span>