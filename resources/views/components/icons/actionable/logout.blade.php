@props([
    'active' => false,
    'size',
    'stroke' => 2,
    'color' => 'n1000',
    'colorActive' => $color,
    'id',
])

<span
    {{isset($id)?'id="'.$id.'"':''}} {{ $active ? $attributes->merge(['class' => 'tw-stroke-' . $colorActive . '']) : $attributes->merge(['class' => 'tw-stroke-' . $color . '']) }}>
    <svg width="{{ isset($size) ? $size : 25 }}" height="{{ isset($size) ? $size : 24 }}" viewBox="0 0 25 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M9.54703 7.55999C9.85703 3.95999 11.707 2.48999 15.757 2.48999H15.887C20.357 2.48999 22.147 4.27999 22.147 8.74999V15.27C22.147 19.74 20.357 21.53 15.887 21.53H15.757C11.737 21.53 9.88703 20.08 9.55703 16.54"
            stroke-width="{{$stroke}}" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M15.647 12H4.26703" stroke-width="{{$stroke}}" stroke-linecap="round"
            stroke-linejoin="round" />
        <path d="M6.49703 8.64999L3.14703 12L6.49703 15.35" stroke-width="{{$stroke}}" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>
</span>
