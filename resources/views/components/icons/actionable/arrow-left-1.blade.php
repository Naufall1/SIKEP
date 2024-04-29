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
            <path d="M15.647 19.92L9.12703 13.4C8.35703 12.63 8.35703 11.37 9.12703 10.6L15.647 4.07999" stroke-width="{{ $stroke }}" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</span>
