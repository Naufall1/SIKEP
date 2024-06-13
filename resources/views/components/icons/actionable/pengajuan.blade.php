@props([
    'active' => false,
    'size',
    'stroke' => 2,
])

<span {{$active ? $attributes->merge(['class'=>'tw-stroke-n100']) : $attributes->merge(['class'=>'tw-stroke-n700']) }}>  
    <svg width="{{ isset($size) ? $size : 25}}" height="{{ isset($size) ? $size : 24}}"  viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
        d="M9.64703 22H15.647C20.647 22 22.647 20 22.647 15V9C22.647 4 20.647 2 15.647 2H9.64703C4.64703 2 2.64703 4 2.64703 9V15C2.64703 20 4.64703 22 9.64703 22Z"
        stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
        <path
        d="M2.64703 13H6.40703C7.16703 13 7.85703 13.43 8.19703 14.11L9.08703 15.9C9.64703 17 10.647 17 10.887 17H14.417C15.177 17 15.867 16.57 16.207 15.89L17.097 14.1C17.437 13.42 18.127 12.99 18.887 12.99H22.627"
        stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10.987 7H14.317" stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M10.147 10H15.147" stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</span>
