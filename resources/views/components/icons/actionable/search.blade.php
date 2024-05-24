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
        <path d="M12.147 21C17.3937 21 21.647 16.7467 21.647 11.5C21.647 6.25329 17.3937 2 12.147 2C6.90033 2 2.64703 6.25329 2.64703 11.5C2.64703 16.7467 6.90033 21 12.147 21Z"
            stroke-width="{{ $stroke }}" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M22.647 22L20.647 20" 
            stroke-width="{{ $stroke }}" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</span>