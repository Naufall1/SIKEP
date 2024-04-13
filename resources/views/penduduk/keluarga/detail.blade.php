@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Keluarga /
            <span class="tw-font-bold tw-text-b500">Detail Keluarga</span>
        </p>

        <div class="md:tw-w-full">

            <div
                class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RT' ? 'tw-justify-between' : '' }}  tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Data Keluarga</h1>
                @if (Auth::user()->hasLevel['level_kode'] == 'RT')
                    <a href=""
                        class="tw-flex tw-items-center tw-relative tw-h-10 tw-pl-10 tw-pr-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-sm tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
                        type="button">
                        <span
                            class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-pl-2 tw-cursor-pointer">
                            <img class="tw-h-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/edit.svg') }}"
                                alt="edit">
                        </span>
                        <span class="">
                            Perbarui
                        </span>
                    </a>
                @endif
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Detail Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'No KK',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kepala Keluarga',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Alamat',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kode POS',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'RT',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'RW',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kelurahan',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kecamatan',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kota',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Provinsi',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kartu Keluarga',
                                'isImage' => true,
                                'content' => 'akfdj',
                            ]) {{-- kalau label kasih value var $isLabel with true --}}


                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Tagihan Listrik',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Luas Bangunan',
                                'content' => 'akfdj',
                            ])

                        </div>
                    </div>


                    <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-overflow-x-scroll">
                        <h2 class="">Anggota Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <table class="tw-w-[702px] md:tw-w-full">
                                {{-- <thead class="tw-rounded-lg"> --}}
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Status Keluarga</th>
                                    <th class="tw-w-[108px]"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($collection as $item) --}}
                                        <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td
                                                class="tw-w-[140px] tw-h-16 tw-flex tw-items-center tw-justify-center tw-gap-2">
                                                <a href=""
                                                    class="tw-h-10 tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-overflow-x-scroll">
                        <h2 class="">Daftar Bansos</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <table class="tw-w-[702px] md:tw-w-full">
                                {{-- <thead class="tw-rounded-lg"> --}}
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                    <th>No</th>
                                    <th>Nama Bansos</th>
                                    <th>Tanggal Menerima</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($collection as $item) --}}
                                        <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    {{-- @endforeach --}}

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>


                <div class="tw-flex">
                    <a href="{{ url()->previous() }}"
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
                </div>
            </div>

        </div>
    </div>
@endsection