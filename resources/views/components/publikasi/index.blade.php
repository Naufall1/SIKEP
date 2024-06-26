@props(['title', 'created_at', 'writer', 'image_url', 'caption'])

@php
    use Carbon\Carbon;
@endphp

<div class="md:tw-w-full tw-flex tw-flex-col tw-gap-4">

    <div class="tw-flex tw-flex-col tw-gap-2">
        <h1 class="tw-display">{{$title}}</h1>
        <div class="tw-flex">
            <p class="tw-caption tw-text-n600">{{Carbon::parse($created_at)->locale('id')->translatedFormat('l')}}, {{Carbon::parse($created_at)->locale('id')->translatedFormat('d F Y')}} -&nbsp;</p>
            <p class="tw-caption tw-text-n1000">{{$writer}}</p>
        </div>
    </div>

    <div class="tw-flex tw-flex-col tw-gap-2">
        <img src="{{Storage::disk('public')->has('publikasi/' . $image_url)
        ? asset(Storage::disk('public')->url('publikasi/' . $image_url))
        : asset(Storage::disk('public')->url('publikasi/default.jpg'))}}" alt="thumbnail" class="tw-w-full">
            <p class="tw-caption tw-text-n600">{{$caption}}</p>
    </div>

    {{-- CONTENT WYSIWIG START --}}

    <p class="tw-body tw-text-base">{{$slot}}</p>
    {{-- {!! $announcement->isi !!} --}}

    {{-- CONTENT WYSIWIG END --}}

</div>