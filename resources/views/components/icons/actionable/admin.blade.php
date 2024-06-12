@props([
    'active' => false,
    'size',
    'stroke' => 2,
])

<span
    {{ $active ? $attributes->merge(['class' => 'tw-stroke-n100']) : $attributes->merge(['class' => 'tw-stroke-n700']) }}>
    <svg width="{{ isset($size) ? $size : 25 }}" height="{{ isset($size) ? $size : 24 }}" viewBox="0 0 25 24" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M18.647 18.86H17.887C17.087 18.86 16.327 19.17 15.767 19.73L14.057 21.42C13.277 22.19 12.0071 22.19 11.2271 21.42L9.51703 19.73C8.95703 19.17 8.18703 18.86 7.39703 18.86H6.64703C4.98703 18.86 3.64703 17.53 3.64703 15.89V4.97C3.64703 3.33 4.98703 2 6.64703 2H18.647C20.307 2 21.647 3.33 21.647 4.97V15.88C21.647 17.52 20.307 18.86 18.647 18.86Z"
            stroke-width="{{ $stroke }}" stroke-linecap="round" stroke-linejoin="round" />
        <path
        d="M12.717 8.94999C12.677 8.94999 12.617 8.94999 12.567 8.94999C11.517 8.90999 10.687 8.05999 10.687 6.99999C10.687 5.91999 11.557 5.04999 12.637 5.04999C13.717 5.04999 14.587 5.92999 14.587 6.99999C14.597 8.05999 13.767 8.91999 12.717 8.94999Z"
            stroke-width="{{ $stroke }}" stroke-linecap="round" stroke-linejoin="round" />
        <path
        d="M9.89704 11.96C8.56704 12.85 8.56704 14.3 9.89704 15.19C11.407 16.2 13.887 16.2 15.397 15.19C16.727 14.3 16.727 12.85 15.397 11.96C13.887 10.96 11.417 10.96 9.89704 11.96Z"
            stroke-width="{{ $stroke }}" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</span>
