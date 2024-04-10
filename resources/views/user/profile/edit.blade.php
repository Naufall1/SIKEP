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

                            <label for="old_password" class="tw-w-full tw-flex tw-flex-col tw-gap-2">
                                <div class="tw-align-text-bottom">
                                    <span class="tw-label"> Kata Sandi Lama</span>
                                    @if (session('error'))
                                        <span class="tw-pl-1 tw-text-r500 tw-caption tw-h-fit">
                                            {{ session('error') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <input class="tw-input-enabled" type="password" id="old_password" name="old_password"
                                        placeholder="Masukkan Kata Sandi" >
                                    <span id=""
                                        class="togglePassword tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2 tw-cursor-pointer">
                                        <img id="eyeIcon" src="{{ asset('assets/icons/actionable/eye.svg') }}"
                                            alt="eye">
                                    </span>
                                </div>
                            </label>

                            <label for="password" class="tw-w-full tw-flex tw-flex-col tw-gap-2">
                                <span class="tw-label">Kata Sandi Baru</span>
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <input class="tw-input-enabled" type="password" id="password" name="password"
                                        placeholder="Masukkan Kata Sandi" >
                                    <span id=""
                                        class="togglePassword tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2 tw-cursor-pointer">
                                        <img id="eyeIcon" src="{{ asset('assets/icons/actionable/eye.svg') }}"
                                            alt="eye">
                                    </span>
                                </div>
                            </label>

                            <label for="password" class="tw-w-full tw-flex tw-flex-col tw-gap-2">
                                <div class="tw-flex">
                                    <span class="tw-label">Ulangi Kata Sandi Baru</span>
                                    @if (session('error'))
                                        
                                    @endif
                                </div>
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <input class="tw-input-enabled" type="password" id="password" name="password"
                                        placeholder="Masukkan Kata Sandi" >
                                    <span id=""
                                        class="togglePassword tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2 tw-cursor-pointer">
                                        <img id="eyeIcon" src="{{ asset('assets/icons/actionable/eye.svg') }}"
                                            alt="eye">
                                    </span>
                                </div>
                            </label>

                        </div>
                    </div>
                </div>


                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ route('profil') }}"
                        class="tw-relative tw-min-w-16 tw-flex tw-items-center tw-px-5 tw-h-11 md:tw-pl-12 md:tw-pr-6 tw-bg-n100 tw-border-2 tw-border-n500 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n300 active:tw-border-n1000"
                        type="button">
                        <span
                            class="md:tw-absolute md:tw-top-1/2 md:-tw-translate-y-1/2 md:tw-left-2 tw-flex tw-items-center md:tw-pl-2 tw-cursor-pointer">
                            <img src="{{ asset('assets/icons/actionable/arrow-left.svg') }}" alt="back">
                        </span>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button href="{{ route('keluarga-tambah') }}" type="submit"
                        class="tw-h-11 tw-flex tw-px-6 tw-bg-b500 tw-text-n100 tw-items-center tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
                        type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.togglePassword').click(function() {
                const type = $(this).siblings().attr('type') === 'password' ? 'text' : 'password';
                $(this).siblings().attr('type', type);

                if (type === 'password') {
                    $(this).children().attr('src', "{{ asset('assets/icons/actionable/eye.svg') }}");
                } else {
                    $(this).children().attr('src', "{{ asset('assets/icons/actionable/eye-slash.svg') }}");
                }

            });
        });
    </script>
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
