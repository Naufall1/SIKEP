@extends('layout.layout', ['isForm' => false])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10  tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        <p class="tw-breadcrumb tw-text-n500">
            <span class="tw-font-bold tw-text-b500">Profil</span>
        </p>

        <div class="tw-w-full">

            <div class="tw-flex tw-justify-between tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Profil</h1>
                <a href="{{ route('profilFormEdit', ['user_id' => $user->user_id]) }}"
                    class="tw-btn tw-btn-primary tw-btn-md-ilead tw-rounded-full" type="button">
                    <x-icons.actionable.edit class="" stroke="2" size="20"
                        color="n100"></x-icons.actionable.edit>
                    <span class="">
                        Perbarui
                    </span>
                </a>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">
                        <h2 class="">Profil</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'isImage' => false,
                                'title' => 'Nama',
                                'content' => $user->nama,
                            ])

                            @include('components.form.textdetail', [
                                'isImage' => false,
                                'title' => 'Keterangan',
                                'content' => $user->keterangan,
                            ])

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[400ms]">
                        <h2 class="">Akun</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'isImage' => false,
                                'title' => 'Nama Pengguna',
                                'content' => $user->username,
                            ])

                        </div>
                    </div>


                </div>
                <div class="tw-flex tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[600ms]">
                    <a href="{{ route('home')}}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
                        type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
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
