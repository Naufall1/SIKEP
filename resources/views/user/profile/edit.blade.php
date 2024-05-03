@extends('layout.layout', ['isForm' => true])


@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Profil /
            <span class="tw-font-bold tw-text-b500">Ubah Profil</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Ubah Profil</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('profilUpdate', ['user_id' => $user->user_id]) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Profil</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama">Nama
                                <input class="tw-input-enabled tw-placeholder" placeholder="{{ $user->username }}"
                                    value="{{ $user->username }}" type="text" id="nama" name="nama">
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="keterangan">Keterangan
                                <textarea class="tw-input-disabled tw-pt-[9px] tw-placeholder" placeholder="{{ $user->keterangan }}" type="text"
                                    id="keterangan" name="keterangan" value="" disabled>{{ $user->keterangan }}</textarea>
                            </label>

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Akun</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="username">Nama Pengguna
                                <input class="tw-input-enabled tw-placeholder" placeholder="{{ $user->username }}"
                                    type="text" id="username" name="username" value="{{ $user->username }}">
                            </label>

                            <x-input.label class="tw-w-full" for="old_password" label="Kata Sandi Lama">
                                <x-input.password placeholder="Masukkan Kata Sansi" id="old_password"
                                    name="old_password"></x-input.password>
                                @if (session('error'))
                                    <span class="tw-pl-1 tw-text-r500 tw-caption tw-h-fit">
                                        {{ session('error') }}
                                    </span>
                                @endif
                            </x-input.label>

                            <x-input.label class="tw-w-full" for="password" label="Kata Sandi Baru">
                                <x-input.password placeholder="Masukkan Kata Sansi" id="password"
                                    name="password"></x-input.password>
                                @if (session('error'))
                                    <span class="tw-pl-1 tw-text-r500 tw-caption tw-h-fit">
                                        {{ session('error') }}
                                    </span>
                                @endif
                            </x-input.label>

                            <x-input.label class="tw-w-full" for="password" label="Ulangi Kata Sandi Baru">
                                <x-input.password placeholder="Masukkan Kata Sansi" id="password"
                                    name="password"></x-input.password>
                                @if (session('error'))
                                    <span class="tw-pl-1 tw-text-r500 tw-caption tw-h-fit">
                                        {{ session('error') }}
                                    </span>
                                @endif
                            </x-input.label>

                        </div>
                    </div>
                </div>


                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ route('profil') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
                        type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button href="{{ route('keluarga-tambah') }}" type="submit"
                        class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round" type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
</head>
<body>
    <h1>Edit Profilku</h1>
    flash message dadakno kudu dikei ngene wkw
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('profilUpdate', ['user_id' => $user->user_id]) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="old_password">Password Lama:</label><br>
    <input type="password" id="old_password" name="old_password" required><br>

    <label for="password">Password Baru:</label><br>
    <input type="password" id="password" name="password"><br>

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" value="{{ $user->username }}"><br>

    <label for="nama">Nama:</label><br>
    <input type="text" id="nama" name="nama" value="{{ $user->nama }}"><br>

    <label for="keterangan">Keterangan:</label><br>
    <textarea id="keterangan" name="keterangan">{{ $user->keterangan }}</textarea><br>

    <button type="submit">Simpan</button>
</form>
</body>

</html> --}}
