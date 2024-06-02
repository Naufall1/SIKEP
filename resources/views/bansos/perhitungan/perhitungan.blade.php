@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush


@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[768px] tw-flex tw-flex-col tw-gap-2 tw-pb-10  tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">

        <p class="tw-breadcrumb tw-text-n500">Perhitungan /
            <span class="tw-font-bold tw-text-b500">Detail Perhitungan</span>
        </p>
        <div class="md:tw-w-full tw-flex tw-flex-col tw-gap-8">
            @include('bansos.perhitungan.metode.merec')
            @include('bansos.perhitungan.metode.aras')
            <div class="tw-flex">
                <a href="{{ route('bansos.kriteria') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
                    type="button">
                    <x-icons.actionable.arrow-left class="" stroke="1.5"
                        color="n1000"></x-icons.actionable.arrow-left>
                    <span class="tw-hidden md:tw-inline-block">
                        Kembali
                    </span>
                </a>
            </div>
        </div>

    </div>
    @if (Session::has('message'))
        <script>
            alert('{{ Session::get('message') }}');
        </script>
    @endif
@endsection


@push('js')
    <script src="{{ asset('assets/plugins/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/1.10.25/js/dataTables.bootstrap.min.js') }}"></script>
@endpush