@props([
    'active' => false,
    'size',
    'stroke' => 2,
])

<span {{$active ? $attributes->merge(['class'=>'tw-stroke-n100']) : $attributes->merge(['class'=>'tw-stroke-n1000']) }}>  
    <svg width="{{ isset($size) ? $size : 25}}" height="{{ isset($size) ? $size : 24}}"  viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12.647 18V15" stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M10.717 2.82L3.78704 8.37C3.00704 8.99 2.50704 10.3 2.67704 11.28L4.00704 19.24C4.24704 20.66 5.60704 21.81 7.04704 21.81H18.247C19.677 21.81 21.047 20.65 21.287 19.24L22.617 11.28C22.777 10.3 22.277 8.99 21.507 8.37L14.577 2.83C13.507 1.97 11.777 1.97 10.717 2.82Z" stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</span>

