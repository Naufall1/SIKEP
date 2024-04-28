@extends('layout.layout', ['isForm' => false])

@section('content')
    <div class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <div class="tw-flex tw-items-center md:tw-items-start tw-justify-between">
            <h1 class="tw-h1 tw-w-1/2">
                Penerimaan Bansos
            </h1>

            {{-- <a href=""class="tw-h-10 tw-px-4 md:tw-h-11 md:tw-px-6 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center"> Tambah Data</a>     --}}
        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            <div class="tw-flex">
                <a href=""
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 tw-border-b-[2px] tw-border-b500 tw-top-menu-text">
                    Kriteria
                </a>
                <a href=""
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-px-2 tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600 hover:tw-text-n700">
                    Perhitungan
                </a>
                <div
                    class="tw-flex tw-justify-center tw-items-center tw-h-8 tw-w-full tw-border-b-[1px] tw-border-n400 tw-top-menu-text tw-text-n600">
                </div>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-3">
                {{-- Start: Tool Bar --}}
                <div class="tw-flex tw-gap-2 tw-w-full">
                    {{-- IF NOT RW = HIDE --}}
                    <button
                        class="tw-relative tw-h-11 tw-pr-8 tw-pl-3 tw-bg-n100 tw-border-[1.5px] tw-border-n400 tw-font-sans tw-font-bold tw-text-base tw-rounded-lg hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n100 focus:tw-border-b500 focus:tw-border-2"
                        type="button">
                        <span class="tw-placeholder">
                            Semua
                        </span>
                        <span
                            class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-2 tw-flex tw-items-center  tw-cursor-pointer">
                            <img class="tw-w-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                alt="back">
                        </span>
                    </button>

                    <button
                        class="tw-relative tw-h-11 tw-pl-8 tw-pr-3 tw-bg-n100 tw-border-[1.5px] tw-border-n400 tw-font-sans tw-font-bold tw-text-base tw-rounded-lg hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n100 focus:tw-border-b500 focus:tw-border-2"
                        type="button">
                        <span
                            class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-2 tw-flex tw-items-center  tw-cursor-pointer">
                            <img class="tw-w-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/filter.svg') }}"
                                alt="back">
                        </span>
                        <span class="tw-placeholder">
                            Filter
                        </span>
                    </button>
                    <div class="tw-relative tw-flex tw-w-full tw-grid-rows-3">
                        <input type="text" placeholder="Cari"
                            class="tw-input-enabled md:tw-w-80 tw-h-11 tw-pl-8 tw-pr-3 tw-bg-n100 tw-border-[1.5px]"
                            type="button">
                        </input>
                        <span
                            class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-2 tw-flex tw-items-center tw-cursor-pointer">
                            <img class="tw-w-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/search.svg') }}"
                                alt="back">
                        </span>
                    </div>
                </div>
                {{-- End: Tool Bar --}}

                {{-- Start: Table HERE --}}
                <div class="tw-w-vw tw-overflow-x-scroll">

                    <table class="tw-min-w-[1400px] md:tw-w-full">
                        <thead>
                            <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                <th>No</th>
                                <th>Kepala Keluarga</th>
                                <th>Tagihan Listrik</th>
                                <th>Luas Bangunan</th>
                                <th>Total Penghasilan Keluarga</th>
                                <th>Jumlah Warga dengan Penghasilan</th>
                                <th>Tanggungan</th>
                                <th>Jumlah Bersekolah</th>
                                <th class="tw-w-[108px]"></th>
                            </tr>
                        </thead>
                        <tbody class="tw-divide-y-2 tw-divide-n400">
                            @foreach ($dataKeluarga as $k)
                                <tr class="tw-h-16 hover:tw-bg-n300">
                                    <td></td>
                                    <td>{{ $k->kepala_keluarga }}</td>
                                    <td>{{ $k->tagihan_listrik }}</td>
                                    <td>{{ $k->luas_bangunan }} m</td>
                                    <td>{{ $k->total_penghasilan }}</td>
                                    <td>{{ $k->jumlah_warga_berpenghasilan }}</td>
                                    <td>{{ $k->tanggungan }}</td>
                                    <td>{{ $k->jumlah_warga_bersekolah }}</td>
                                    <td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center">
                                        <a href="{{ route('kriteriaForm', $k->no_kk) }}"
                                            class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                            Ubah
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div>

                    </div>

                </div>
                {{-- End: Table HERE --}}
            </div>

            <div class="tw-flex tw-border-[1.5px] tw-divide-x-[1.5px] tw-border-n400 tw-divide-n400 tw-w-fit tw-rounded-lg">
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300" href="">
                    <img class="tw-h-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/arrow-left-1.svg') }}"
                        alt="<">
                </a>
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300 tw-bg-n400"
                    href="">
                    1
                </a>
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300" href="">
                    2
                </a>
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300" href="">
                    ...
                </a>
                <a class="tw-h-7 tw-w-7 tw-flex tw-items-center tw-justify-center hover:tw-bg-n300" href="">
                    <img class="tw-h-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/arrow-right-1.svg') }}"
                        alt="<">
                </a>
            </div>

        </div>
    </div>
@endsection
{{-- <!DOCTYPE html>
<html>
<head>
    <title>Daftar Kriteria</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Kriteria</h1>
    <table>
        <thead>
            <tr>
                <th>Kepala Keluarga</th>
                <th>Tagihan Listrik</th>
                <th>Luas Bangunan</th>
                <th>Total Penghasilan Keluarga</th>
                <th>Jumlah Warga dengan Penghasilan</th>
                <th>Tanggungan</th>
                <th>Jumlah Bersekolah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataKeluarga as $k)
            <tr>
                <td>{{ $k->kepala_keluarga }}</td>
                <td>{{ $k->tagihan_listrik }}</td>
                <td>{{ $k->luas_bangunan }} m</td>
                <td>{{ $k->total_penghasilan }}</td>
                <td>{{ $k->jumlah_warga_berpenghasilan }}</td>
                <td>{{ $k->tanggungan }}</td>
                <td>{{ $k->jumlah_warga_bersekolah }}</td>
                <td><a href="{{ route('kriteriaForm', $k->no_kk) }}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> --}}
