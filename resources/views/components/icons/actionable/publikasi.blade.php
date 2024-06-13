@props([
    'active' => false,
    'size',
    'stroke' => 2,
])

<span {{$active ? $attributes->merge(['class'=>'tw-stroke-n100']) : $attributes->merge(['class'=>'tw-stroke-n700']) }}>  
    <svg width="{{ isset($size) ? $size : 25}}" height="{{ isset($size) ? $size : 24}}"  viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12.977 12.15L10.507 14.62C9.13703 15.99 9.13703 18.2 10.507 19.57C11.877 20.94 14.087 20.94 15.457 19.57L19.347 15.68C22.077 12.95 22.077 8.51 19.347 5.78C16.617 3.05 12.177 3.05 9.44703 5.78L5.20703 10.02C2.86703 12.36 2.86703 16.16 5.20703 18.51" stroke-width="{{$stroke}}" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
</span>