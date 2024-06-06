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
                <x-cards.overview class="md:tw-col-span-1 tw-col-span-2" url="{{ route('penduduk.warga') }}" title="Jumlah Penduduk" value='{{$countPenduduk}}'></x-cards.overview>
                <x-cards.overview class="tw-col-span-1" url="{{ route('keluarga') }}" title="Jumlah Keluarga" value='{{$countKeluarga}}'></x-cards.overview>
                <x-cards.overview class="tw-col-span-1" url="{{ route('pengajuan') }}" title="Pengajuan" value='{{$countPengajuan}}'></x-cards.overview>
            </div>

            <div class="tw-grid tw-grid-cols-6 tw-gap-4 tw-h-full tw-w-full">
                <x-cards.chart class="tw-overflow-x-auto tw-col-span-6 md:tw-col-span-3">
                    @include('dashboard.chart.lineChart')
                </x-cards.chart>
                <x-cards.chart class="tw-overflow-x-auto tw-col-span-6 md:tw-col-span-3">
                    @include('dashboard.chart.barChart')
                </x-cards.chart>
                <x-cards.chart class="tw-overflow-x-auto tw-col-span-6 md:tw-col-span-2">
                    @include('dashboard.chart.pieChart')
                </x-cards.chart>
                <x-cards.chart class="tw-overflow-x-auto tw-col-span-6 md:tw-col-span-4 tw-h-full">
                    <div class="tw-w-full tw-flex tw-justify-between text">
                        <h2>Pengajuan Menunggu</h2>
                        <a href="{{route('pengajuan')}}" class="tw-text-b500 tw-body">Lihat Semua</a>
                    </div>
                    <table class="tw-w-full" id="tablePengajuan">
                        <thead>
                            <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg tw-flex">
                                <th class="tw-flex tw-w-grow">Pengaju</th>
                                <th class="md:tw-w-[200px] md:tw-grow-0 tw-grow-0">Jenis</th>
                                <th class="tw-w-[136px] tw-grow-0 tw-hidden md:tw-flex">Tanggal</th>
                                <th class="tw-w-[108px] tw-grow-0"></th>
                            </tr>
                        </thead>
                        <tbody class="tw-divide-n400">
                            {{-- Maks 5 --}}
                            <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                <td class="tw-w-grow">Pengaju</td>
                                <td class="md:tw-w-[200px] md:tw-grow-0 tw-grow-0">Jenis</td>
                                <td class="tw-w-[136px] tw-grow-0 tw-hidden md:tw-flex">Tanggal</td>
                                <td class="tw-w-[108px] tw-grow-0"></td>
                            </tr>
                            <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                <td class="tw-w-grow">Pengaju</td>
                                <td class="md:tw-w-[200px] md:tw-grow-0 tw-grow-0">Jenis</td>
                                <td class="tw-w-[136px] tw-grow-0 tw-hidden md:tw-flex">Tanggal</td>
                                <td class="tw-w-[108px] tw-grow-0"></td>
                            </tr>
                            <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                <td class="tw-w-grow">Pengaju</td>
                                <td class="md:tw-w-[200px] md:tw-grow-0 tw-grow-0">Jenis</td>
                                <td class="tw-w-[136px] tw-grow-0 tw-hidden md:tw-flex">Tanggal</td>
                                <td class="tw-w-[108px] tw-grow-0"></td>
                            </tr>
                            <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                <td class="tw-w-grow">Pengaju</td>
                                <td class="md:tw-w-[200px] md:tw-grow-0 tw-grow-0">Jenis</td>
                                <td class="tw-w-[136px] tw-grow-0 tw-hidden md:tw-flex">Tanggal</td>
                                <td class="tw-w-[108px] tw-grow-0"></td>
                            </tr>
                            <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1px] tw-border-n400 tw-flex">
                                <td class="tw-w-grow">Pengaju</td>
                                <td class="md:tw-w-[200px] md:tw-grow-0 tw-grow-0">Jenis</td>
                                <td class="tw-w-[136px] tw-grow-0 tw-hidden md:tw-flex">Tanggal</td>
                                <td class="tw-w-[108px] tw-grow-0"></td>
                            </tr>
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
                </x-cards.chart>
            </div>
        </div>
        <div class="tw-flex tw-w-full">
            <iframe width="100%" height="1000" src="https://lookerstudio.google.com/embed/reporting/02f7484e-e5b8-446a-9b5d-a647347e903d/page/p_8kllclzzhd" frameborder="0" style="border:0" allowfullscreen sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"></iframe>
        </div>


    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/plugins/plugin.zoom.min.js"></script>
    @endpush

    @stack('js')
@endsection
