@props([
    'active' => false,
    'size',
    'stroke' => 2,
    'color' => 'n100',
    'colorActive' => $color,
    'id',
])

<span
    {{isset($id)?'id='.$id.'':''}} {{ $active ? $attributes->merge(['class' => 'tw-stroke-' . $colorActive . '']) : $attributes->merge(['class' => 'tw-stroke-' . $color . '']) }}>
    <svg width="{{ isset($size) ? $size : 25 }}" height="{{ isset($size) ? $size : 24 }}" viewBox="0 0 25 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M8.40439 16.2426L16.8897 7.75736" stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M16.8897 16.2426L8.40439 7.75735" stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</span>