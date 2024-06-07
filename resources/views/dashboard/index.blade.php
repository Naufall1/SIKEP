@extends('layout.layout', ['isForm' => false])

@section('content')
    <div class="tw-pt-[100px] tw-px-5 tw-w-full tw-flex tw-flex-col tw-gap-2 tw-pb-10">

        <div class="tw-flex tw-items-center md:tw-items-start tw-justify-start">
            <h1 class="tw-h1 tw-w-1/2">
                Overview
            </h1>

        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            <div class="tw-grid md:tw-grid-flow-col tw-grid-cols-2 md:tw-grid-cols-3 tw-gap-4">
                {{-- <div class="tw-flex tw-flex-col md:tw-flex-row tw-gap-4"> --}}
                <x-cards.overview class="md:tw-col-span-1 tw-col-span-2" url="{{ route('penduduk.warga') }}"
                    title="Jumlah Penduduk" value='{{ $countPenduduk }}'></x-cards.overview>
                <x-cards.overview class="tw-col-span-1" url="{{ route('keluarga') }}" title="Jumlah Keluarga"
                    value='{{ $countKeluarga }}'></x-cards.overview>
                <x-cards.overview class="tw-col-span-1" url="{{ route('pengajuan') }}" title="Pengajuan"
                    value='{{ $countPengajuan }}'></x-cards.overview>
            </div>

            <div class="tw-grid tw-grid-cols-6 tw-gap-4 tw-h-full tw-w-full">
                <x-cards.chart class="tw-overflow-x-auto tw-col-span-6 md:tw-col-span-3">
                    @include('dashboard.chart.lineChart')
                </x-cards.chart>
                <x-cards.chart class="tw-overflow-x-auto tw-col-span-6 md:tw-col-span-3">
                    @include('dashboard.chart.barChart')
                </x-cards.chart>
                <x-cards.chart class="tw-overflow-x-auto tw-col-span-6 md:tw-col-span-3 lg:tw-col-span-2">
                    @include('dashboard.chart.pieChart')
                </x-cards.chart>
                <x-cards.chart class="tw-overflow-x-auto tw-col-span-6 md:tw-col-span-3 lg:tw-col-span-4 tw-h-full">
                    <div class="tw-w-full tw-flex tw-justify-between text">
                        <h2>Pengajuan Menunggu</h2>
                        <a href="{{ route('pengajuan') }}" class="tw-text-b500 tw-body">Lihat Semua</a>
                    </div>
                    <div class="tw-w-full tw-overflow-x-auto">

                        <table class="tw-w-fit" id="tablePengajuan">
                            <thead>
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                    <th class="tw-min-w-[280px] tw-grow tw-shrink">Pengaju</th>
                                    <th class="tw-min-w-[220px] tw-max-w-[220px]">Jenis</th>
                                    <th class="tw-min-w-[220px] tw-max-w-[220px] tw-table-right-align">Tanggal</th>
                                    <th class="tw-min-w-[108px] tw-max-w-[108px] "></th>
                                </tr>
                            </thead>
                            <tbody class="tw-h-full">
                                {{-- Maks 5 --}}
                                @foreach ($pengajuanTable as $pengajuan)
                                    <tr
                                        class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] last:tw-rounded-r-md tw-border-n400 tw-flex">
                                        <td class="tw-min-w-[280px] tw-grow tw-shrink">{{ $pengajuan->user->nama }}</td>
                                        <td class="tw-min-w-[220px] tw-max-w-[220px]">{{ $pengajuan->tipe }}</td>
                                        <td class="tw-min-w-[220px] tw-max-w-[220px] tw-table-right-align">
                                            {{ strftime('%d %B %Y', strtotime($pengajuan->tanggal_request)) }}</td>
                                        <td class="tw-min-w-[108px] tw-max-w-[108px] "><a
                                                class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md"
                                                href="{{ route('pengajuan.perubahanwarga', ['id' => $pengajuan]) }}">Lihat</a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if (is_null($pengajuanTable))
                                    
                                
                                <tr class="tw-h-full tw-border-0">
                                    <td
                                        class="tw-col-span-4 tw-flex tw-flex-col tw-items-center tw-justify-center tw-h-full tw-py-6 tw-gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="121" fill="none"
                                            viewBox="0 0 150 151">
                                            <g clip-path="url(#a)">
                                                <path fill="#E3E3E3"
                                                    d="M75 150.5c41.421 0 75-33.579 75-75S116.421.5 75 .5 0 34.079 0 75.5s33.579 75 75 75Z" />
                                                <path fill="#fff"
                                                    d="M120 150.5H30v-97a16.018 16.018 0 0 0 16-16h58a15.906 15.906 0 0 0 4.691 11.308A15.89 15.89 0 0 0 120 53.5v97Z" />
                                                <path fill="#0284FF"
                                                    d="M75 102.5c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z" />
                                                <path fill="#fff"
                                                    d="M83.485 89.814 75 81.329l-8.485 8.485-2.829-2.829 8.486-8.485-8.486-8.485 2.829-2.829L75 75.672l8.485-8.486 2.829 2.829-8.486 8.485 8.486 8.485-2.829 2.829Z" />
                                                <path fill="#CCE4FF"
                                                    d="M88 108.5H62a3 3 0 1 0 0 6h26a3 3 0 1 0 0-6Zm9 12H53a3 3 0 1 0 0 6h44a3 3 0 1 0 0-6Z" />
                                            </g>
                                            <defs>
                                                <clipPath id="a">
                                                    <rect width="150" height="150" y=".5" fill="#fff"
                                                        rx="75" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="tw-placeholder tw-font-semibold">Tidak ada data</p>
                                    </td>
                                </tr>
                                @endif
                                {{-- @foreach ($dataBaru as $data) --}}
                                {{-- <tr class="tw-h-16 hover:tw-bg-n300">
                                    <td>1</td>
                                    <td>nama</td>
                                    <td>123123</td>
                                    <td>kepala</td>
                                    <td>tipe</td>
                                    <td class="tw-hidden md:tw-flex tw-min-h-full tw-grow tw-items-center">123123123</td>
                                    <td>
                                        @include('components.form.label', ['content' => 'Menunggu'])
                                    </td>
                                    <td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center">
                                        <a href=""
                                            class="tw-btn tw-btn-primary tw-btn-md tw-btn-round-md">
                                            Detail
                                        </a>
                                    </td>
                                </tr> --}}
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>

                </x-cards.chart>
            </div>
        </div>
        <div class="tw-flex tw-w-full">
            <iframe width="100%" height="1000"
                src="https://lookerstudio.google.com/embed/reporting/02f7484e-e5b8-446a-9b5d-a647347e903d/page/p_8kllclzzhd"
                frameborder="0" style="border:0" allowfullscreen
                sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
        </div>


    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/plugins/plugin.zoom.min.js"></script>
    @endpush

    @stack('js')
@endsection
