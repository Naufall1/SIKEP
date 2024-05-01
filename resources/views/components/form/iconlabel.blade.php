@props([
    'content'
])
<div class="tw-flex tw-py-1 tw-px-2 tw-rounded-sm tw-bg-300 tw-w-fit tw-h-fit tw-gap-1 {{strtolower($content) == 'pengumuman' ? 'tw-bg-r50' : 'tw-bg-b50'}}">
    <x-icons.information.verify class="{{strtolower($content) == 'pengumuman' ? '' : 'tw-stroke-b500'}}" size="20" color="{{strtolower($content) == 'pengumuman' ? 'r500' : 'b500'}}" stroke="2"></x-icons.actionable.verify>
    <p class="tw-font-sans tw-font-bold tw-text-sm {{strtolower($content) == 'pengumuman' ? 'tw-text-r500' : 'tw-text-b500'}}">{{ucfirst($content)}}</p>
</div>