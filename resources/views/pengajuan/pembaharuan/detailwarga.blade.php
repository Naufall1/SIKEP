@extends('layout.layout', ['isForm' => false])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Data Baru / Detail Pengajuan / 
            <span class="tw-font-bold tw-text-b500">Detail Anggota</span>
        </p>

        <div class="md:tw-w-fit">

            <div
                class="tw-flex tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Anggota Keluarga</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Identitas</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">
                            @include('components.form.textdetail', [
                                'title' => 'NIK',
                                'content' => 'Dummy'
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nama',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Tempat Lahir',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Tanggal Lahir',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Jenis Kelamin',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Pendidikan',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Agama',
                                'content' => 'Dummy'
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status Perkawinan',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Pekerjaan',
                                'content' => 'Dummy'
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kewarganegaraan',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status Warga',
                                'content' => 'Aktif' ,
                                'isLabel' => true,
                            ]) {{-- kalau label kasih value var $isLabel with true --}}

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Status Keluarga',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nama Ayah',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nama Ibu',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Penghasilan',
                                'content' => 'Rp. ' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nomor Paspor',
                                'content' => 'Dummy' ,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nomor Kitas',
                                'content' => 'Dummy' ,
                            ])

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col md:tw-flex-row md:tw-justify-between">

                        <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                            <h2 class="">Demografi Masuk</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">
                                @include('components.form.textdetail', [
                                    'title' => 'Jenis',
                                    'content' => 'Dummy' ,
                                ])
                                @include('components.form.textdetail', [
                                    'title' => 'Tanggal',
                                    'content' => 'Dummy' ,
                                ])
                                @include('components.form.textdetail', [
                                    'isImage' => true,
                                    'title' => 'Berkas Pendukung',
                                    'content' => 'Dummy' 
                                ]) {{-- kalau label kasih value var $isLabel with true --}}

                            </div>
                        </div>
                    </div>
                </div>


                <div class="tw-flex">
                    <a href="#"
                        class="tw-relative tw-min-w-16 tw-flex tw-items-center tw-px-5 tw-h-11 md:tw-pl-12 md:tw-pr-6 tw-border-2 tw-border-n500 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n300 active:tw-border-n1000"
                        type="button">
                        <span
                            class="md:tw-absolute md:tw-top-1/2 md:-tw-translate-y-1/2 md:tw-left-2 tw-flex tw-items-center md:tw-pl-2 tw-cursor-pointer">
                            <img src="{{ asset('assets/icons/actionable/arrow-left.svg') }}" alt="back">
                        </span>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>

@endsection
