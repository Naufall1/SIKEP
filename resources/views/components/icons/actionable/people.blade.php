@props([
    'active' => false,
    'size',
    'stroke' => 2,
])

<span {{$active ? $attributes->merge(['class'=>'tw-stroke-n100']) : $attributes->merge(['class'=>'tw-stroke-n700']) }}>
    <svg width="{{ isset($size) ? $size : 25}}" height="{{ isset($size) ? $size : 24}}" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M9.80703 10.87C9.70703 10.86 9.58703 10.86 9.47703 10.87C7.09703 10.79 5.20703 8.84 5.20703 6.44C5.20703 3.99 7.18703 2 9.64703 2C12.097 2 14.087 3.99 14.087 6.44C14.077 8.84 12.187 10.79 9.80703 10.87Z"
            stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M17.057 4C18.997 4 20.557 5.57 20.557 7.5C20.557 9.39 19.057 10.93 17.187 11C17.107 10.99 17.017 10.99 16.927 11"
            stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M4.80703 14.56C2.38703 16.18 2.38703 18.82 4.80703 20.43C7.55703 22.27 12.067 22.27 14.817 20.43C17.237 18.81 17.237 16.17 14.817 14.56C12.077 12.73 7.56703 12.73 4.80703 14.56Z"
            stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
        <path
            d="M18.987 20C19.707 19.85 20.387 19.56 20.947 19.13C22.507 17.96 22.507 16.03 20.947 14.86C20.397 14.44 19.727 14.16 19.017 14"
            stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</span>

