
@extends('layout.layout', ['isForm' => false])

@section('content')

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/plugins/plugin.zoom.min.js"></script>
@endpush

@stack('js')
@include('dashboard.chart.pekerjaan')
{{-- @include('dashboard.chart.jenisKelamin') --}}

@endsection
