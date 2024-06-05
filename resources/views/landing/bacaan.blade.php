@extends('layout.layout', ['isForm' => true])

@section('content')
<div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
    <p class="tw-breadcrumb tw-text-n500">Beranda /
        <span class="tw-font-bold tw-text-b500">Artikel atau Pengumuman</span>
    </p>

    <x-publikasi.index title="{{$announcement->judul}}" created_at="{{$announcement->tanggal_dibuat}}" writer="{{$announcement->penulis}}" image_url="{{ $announcement->image_url}}" caption="{{ $announcement->caption}}">
        {{$announcement->isi}}
    </x-publikasi.index>

    <div class="tw-flex tw-justify-between tw-pt-4 tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
        <a href="{{ route('home') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
            type="button">
            <x-icons.actionable.arrow-left class="" stroke="1.5"
                color="n1000"></x-icons.actionable.arrow-left>
            <span class="tw-hidden md:tw-inline-block">
                Kembali
            </span>
        </a>
    </div>
</div>
@endsection