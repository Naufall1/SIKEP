@props(['title', 'created_at', 'writer'])

<div class="md:tw-w-full tw-flex tw-flex-col tw-gap-4">

    <div class="tw-flex tw-flex-col tw-gap-2">
        <h1 class="tw-display">{{$title}}</h1>
        <div class="tw-flex">
            <p class="tw-caption tw-text-n600">{{$created_at}} -&nbsp;</p>
            <p class="tw-caption tw-text-n1000">{{$writer}}</p>
        </div>
    </div>

    <div class="tw-flex tw-flex-col tw-gap-2">
        <img src="image" alt="thumbnail" class="tw-w-full">
            <p class="tw-caption tw-text-n600">Taman Sale jadi andalan RW 2 Gadingkasri untuk membuat lahan lebih produktif dan ramah lingkungan. (Imam N / Radar Malang)</p>
    </div>

    {{-- CONTENT WYSIWIG START --}}

    {{$slot}}
    {{-- {!! $announcement->isi !!} --}}

    {{-- CONTENT WYSIWIG END --}}
    
</div>