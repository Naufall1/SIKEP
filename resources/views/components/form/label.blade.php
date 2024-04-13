@if (strtolower($content) == 'aktif' || strtolower($content) == 'dikonfirmasi' || strtolower($content) == 'ditampilkan')
<div class="tw-flex tw-py-1 tw-px-2 tw-rounded-sm tw-bg-g50 tw-w-fit tw-h-fit">
    <p class="tw-font-sans tw-font-bold tw-text-sm tw-text-g500">{{ucfirst($content)}}</p>
</div>
@elseif (strtolower($content) == 'menunggu')
<div class="tw-flex tw-py-1 tw-px-2 tw-rounded-sm tw-bg-y50 tw-w-fit tw-h-fit">
    <p class="tw-font-sans tw-font-bold tw-text-sm tw-text-y500">{{ucfirst($content)}}</p>
</div>

@elseif (strtolower($content) == 'migrasi' || strtolower($content) == 'ditolak' || strtolower($content) == 'disembunyikan')
<div class="tw-flex tw-py-1 tw-px-2 tw-rounded-sm tw-bg-r50 tw-w-fit tw-h-fit">
    <p class="tw-font-sans tw-font-bold tw-text-sm tw-text-r500">{{ucfirst($content)}}</p>
</div>

@else
<div class="tw-flex tw-py-1 tw-px-2 tw-rounded-sm tw-bg-300 tw-w-fit tw-h-fit">
    <p class="tw-font-sans tw-font-bold tw-text-sm tw-text-n700">{{ucfirst($content)}}</p>
</div>

@endif