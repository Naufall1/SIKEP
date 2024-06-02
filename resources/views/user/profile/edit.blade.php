@extends('layout.layout', ['isForm' => true])


@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10  tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
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

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">
                        <h2 class="">Profil</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="nama" label="Nama">
                                <x-input.input value="{{ $user->nama }}" placeholder="{{ $user->nama }}"
                                    type="text" id="nama" name="nama"></x-input.input>
                            </x-input.label>

                            <x-input.label for="keterangan" label="Keterangan">
                                <x-input.textarea name="keterangan" placeholder=""
                                    value="{{ $user->keterangan }}" disabled>
                                </x-input.textarea>
                            </x-input.label>

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[400ms]">
                        <h2 class="">Akun</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="username" label="Nama Pengguna">
                                <x-input.input value="{{ $user->username }}" placeholder="{{ $user->username }}"
                                    type="text" id="username" name="username"></x-input.input>
                            </x-input.label>

                            <x-input.label class="tw-w-full" for="old_password" label="Kata Sandi Lama">
                                <x-input.password placeholder="Masukkan Kata Sandi" id="old_password"
                                    name="old_password"></x-input.password>
                                @if (session('error'))
                                    <span class="tw-pl-1 tw-text-r500 tw-caption tw-h-fit">
                                        {{ session('error') }}
                                    </span>
                                @endif
                            </x-input.label>

                            <x-input.label class="tw-w-full" for="password" label="Kata Sandi Baru">
                                <x-input.password placeholder="Masukkan Kata Sandi" id="password"
                                    name="password"></x-input.password>
                                @if (session('error'))
                                    <span class="tw-pl-1 tw-text-r500 tw-caption tw-h-fit">
                                        {{ session('error') }}
                                    </span>
                                @endif
                            </x-input.label>

                            <x-input.label class="tw-w-full" for="password_ulangi" label="Ulangi Kata Sandi Baru">
                                <x-input.password placeholder="Masukkan Kata Sandi" id="password_ulangi"
                                    name="password_ulangi"></x-input.password>
                                @if (session('error'))
                                    <span class="tw-pl-1 tw-text-r500 tw-caption tw-h-fit">
                                        {{ session('error') }}
                                    </span>
                                @endif
                            </x-input.label>

                        </div>
                    </div>
                </div>


                <div class="tw-flex tw-justify-between tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[600ms]">
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
