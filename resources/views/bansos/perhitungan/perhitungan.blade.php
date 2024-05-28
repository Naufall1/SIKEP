@extends('layout.layout', ['isForm' => false])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[768px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">

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
