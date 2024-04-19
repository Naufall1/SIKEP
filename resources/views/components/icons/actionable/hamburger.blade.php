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
        <path d="M3.64703 7H21.647" stroke-width="{{ $stroke }}" stroke-linecap="round" />
        <path d="M3.64703 12H21.647" stroke-width="{{ $stroke }}" stroke-linecap="round" />
        <path d="M3.64703 17H21.647" stroke-width="{{ $stroke }}" stroke-linecap="round" />
    </svg>
</span>
