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
                <x-cards.overview class="md:tw-col-span-1 tw-col-span-2" url="{{ route('warga') }}" title="Jumlah Penduduk" value='{{$countPenduduk}}'></x-cards.overview>
                <x-cards.overview class="tw-col-span-1" url="{{ route('keluarga') }}" title="Jumlah Keluarga" value='{{$countKeluarga}}'></x-cards.overview>
                <x-cards.overview class="tw-col-span-1" url="{{ route('dataBaru') }}" title="Pengajuan" value='{{$countPengajuan}}'></x-cards.overview>
            </div>

            <div class="tw-grid tw-grid-cols-2 tw-gap-4 tw-min-w-[692px] md:tw-h-full">
                <div class="tw-p-4 tw-h-fit tw-col-span-2 md:tw-col-span-1 tw-flex tw-flex-col tw-gap-4 tw-bg-n100 tw-border-[1.5px] tw-rounded-md">
                    @include('dashboard.chart.lineChart')
                </div>
                <div class="tw-p-4 tw-h-fit tw-col-span-2 md:tw-col-span-1 tw-flex tw-flex-col tw-gap-4 tw-bg-n100 tw-border-[1.5px] tw-rounded-md">
                    @include('dashboard.chart.barChart')
                </div>
                <div class="tw-p-4 tw-h-fit tw-col-span-2 md:tw-col-span-1 tw-flex tw-flex-col tw-gap-4 tw-bg-n100 tw-border-[1.5px] tw-rounded-md">
                    @include('dashboard.chart.pieChart')
                </div>

                <div class="tw-p-4 tw-h-fit tw-col-span-2 md:tw-col-span-1 tw-flex tw-flex-col tw-gap-4 tw-bg-n100 tw-border-[1.5px] tw-rounded-md">
                </div>
                {{-- @include('dashboard.chart.jenisKelamin') --}}
            </div>
        </div>


    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/plugins/plugin.zoom.min.js"></script>
    @endpush

    @stack('js')
@endsection
