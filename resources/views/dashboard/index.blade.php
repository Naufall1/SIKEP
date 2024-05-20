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

            <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-h-full">
                <x-cards.chart>
                    @include('dashboard.chart.lineChart')
                </x-cards.chart>
                <x-cards.chart>
                    @include('dashboard.chart.barChart')
                </x-cards.chart>
                <x-cards.chart>
                    @include('dashboard.chart.pieChart')
                </x-cards.chart>
                <x-cards.chart>
                </x-cards.chart>
            </div>
        </div>


    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/plugins/plugin.zoom.min.js"></script>
    @endpush

    @stack('js')
@endsection
