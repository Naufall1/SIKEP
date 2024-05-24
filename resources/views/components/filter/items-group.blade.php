@props(['title', 'id'])
<div class="tw-flex tw-flex-col tw-gap-2 tw-w-full">
    <h3 class="tw-text-sm">{{$title}}</h3>
    <div class="tw-grid tw-grid-cols-2 tw-gap-2" id="{{$id}}">
        {{$slot}}
    </div>
</div>