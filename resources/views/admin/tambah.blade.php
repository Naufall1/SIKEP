@extends('layout.layout', ['isForm' => true])

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Admin /
            <span class="tw-font-bold tw-text-b500">Tambah Admin</span>
        </p>

        <div class="">

            <h1 class="tw-h1 tw-mb-3">Tambah Admin</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('admin.store') }}" method="POST"
                enctype="multipart/form-data" id="formdata">
                @csrf

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="md:tw-w-80 tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Profil</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label class="tw-relative" for="nama" label="Nama">
                                <x-input.input maxlength=16 type="text" name="nama" placeholder="Masukkan Nama"
                                    value="">
                                </x-input.input>
                                @error('nama')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label for="keterangan" label="Keterangan">
                                <x-input.input type="text" name="keterangan" placeholder="Masukkan Keterangan"
                                    value=""></x-input.input>
                                @error('keterangan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                        </div>

                    </div>

                    <div class=" tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Akun</h2>
                        <div class="md:tw-w-80 tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="username" label="Nama Pengguna">
                                <x-input.input type="text" name="username" placeholder="Masukkan Nama Pengguna"
                                    value=""></x-input.input>
                                @error('username')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label for="password" label="Kata Sandi">
                                <x-input.input type="password" name="password" placeholder="Masukkan Kata Sandi"
                                    value=""></x-input.input>
                                @error('password')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label for="password_confirmation" label="Ulangi Kata Sandi">
                                <x-input.input type="password" name="password_confirmation" placeholder="Masukkan Kata Sandi"
                                    value=""></x-input.input>
                                @error('password_confirmation')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>
                        </div>
                    </div>
                </div>
                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ route('admin') }}"
                        class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline" type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round" type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
