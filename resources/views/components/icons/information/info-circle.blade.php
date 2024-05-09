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
         <path d="M12 2C17.5 2 22 6.5 22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2Z"
            stroke-width="{{ $stroke }}" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
         <path d="M12 16V11"
            stroke-width="{{ $stroke }}" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
         <path d="M11.9945 8H12.0035"
            stroke-width="{{ $stroke }}" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</span>