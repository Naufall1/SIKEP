@extends('layout.layout', ['isForm' => false])

@section('content')

<div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
    <p class="tw-breadcrumb tw-text-n500">
        <span class="tw-font-bold tw-text-b500">Profil</span>
    </p>

    <div class="tw-w-full">

        <div class="tw-flex tw-justify-between tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

            <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Profil</h1>
            <a href="{{ route('profilFormEdit', ['user_id' => $user->user_id]) }}"
                    class="tw-flex tw-items-center tw-relative tw-h-10 tw-pl-10 tw-pr-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-sm tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
                    type="button">
                    <span class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-pl-2 tw-cursor-pointer">
                        <img class="tw-h-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/edit.svg') }}" alt="edit">
                    </span>
                    <span class="">
                        Perbarui
                    </span>
                </a>
        </div>

        <div class="tw-flex tw-flex-col tw-gap-7" >

            <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                <div class="tw-flex tw-flex-col tw-gap-2">
                    <h2 class="">Profil</h2>
                    <div class="tw-flex tw-flex-col tw-gap-3">

                        @include('components.form.textdetail', ['isImage' => false, 'title' => 'Nama', 'content' =>  $user->nama ])

                        @include('components.form.textdetail', ['isImage' => false, 'title' => 'Keterangan', 'content' => $user->keterangan ])

                    </div>
                </div>

                <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                    <h2 class="">Akun</h2>
                    <div class="tw-flex tw-flex-col tw-gap-3">

                        @include('components.form.textdetail', ['isImage' => false, 'title' => 'Nama Pengguna', 'content' =>  $user->username ])

                    </div>
                </div>

                
            </div>
            <div class="tw-flex">
                <a href="{{url()->previous()}}"
                    class="tw-flex tw-items-center tw-relative tw-min-w-16 tw-px-5 tw-h-11 md:tw-pl-12 md:tw-pr-6 tw-border-2 tw-border-n500 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n300 active:tw-border-n1000"
                    type="button">
                    <span class="md:tw-absolute md:tw-top-1/2 md:-tw-translate-y-1/2 md:tw-left-2 tw-flex tw-items-center md:tw-pl-2 tw-cursor-pointer">
                        <img src="{{ asset('assets/icons/actionable/arrow-left.svg') }}" alt="back">
                    </span>
                    <span class="tw-hidden md:tw-inline-block">
                        Kembali
                    </span>
                </a>
            </div>

    </div>
</div>

    
@endsection

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilku</title>
</head>
<body>
    <h1>Profil saya</h1>
    <div>
        <strong>Nama:</strong> {{ $user->nama }}<br>
        <strong>Username:</strong> {{ $user->username }}<br>
        <strong>Jabatan:</strong> {{ $user->level_nama }}<br>
        <strong>Keterangan:</strong> {{ $user->keterangan }}<br>
        <h2>-------------</h2>
        <a href="{{ route('profilFormEdit', ['user_id' => $user->user_id]) }}">Edit Profil</a>
    </div>
</body>
</html> --}}
