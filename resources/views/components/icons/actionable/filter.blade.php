@props([
    'active' => false,
    'size',
    'stroke' => 2,
    'color' => 'n100',
    'colorActive' => $color,
    'id',
])

<span {{ isset($id) ? 'id="' . $id . '"' : '' }}
    {{ $active ? $attributes->merge(['class' => 'tw-stroke-' . $colorActive . '']) : $attributes->merge(['class' => 'tw-stroke-' . $color . '']) }}>
    <svg width="{{ isset($size) ? $size : 25 }}" height="{{ isset($size) ? $size : 24 }}" viewBox="0 0 25 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M6.04703 2.10001H19.247C20.347 2.10001 21.247 3.00001 21.247 4.10001V6.30001C21.247 7.10001 20.747 8.10001 20.247 8.60001L15.947 12.4C15.347 12.9 14.947 13.9 14.947 14.7V19C14.947 19.6 14.547 20.4 14.047 20.7L12.647 21.6C11.347 22.4 9.54703 21.5 9.54703 19.9V14.6C9.54703 13.9 9.14703 13 8.74703 12.5L4.94703 8.50001C4.44703 8.00001 4.04703 7.10001 4.04703 6.50001V4.20001C4.04703 3.00001 4.94703 2.10001 6.04703 2.10001Z"
            stroke-width="{{ $stroke }}" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M11.577 2.10001L6.64703 10" stroke-width="{{ $stroke }}" stroke-miterlimit="10"
            stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</span>
