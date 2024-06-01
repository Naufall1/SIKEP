@extends('layout.layout', ['isForm' => false])

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/1.10.25/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Kriteria /
            <span class="tw-font-bold tw-text-b500">Data Kriteria</span>
        </p>

        <div class="md:tw-w-full">

            <div
                class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RT' ? 'tw-justify-between' : '' }}  tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Data Kriteria</h1>
                @if (Auth::user()->hasLevel['level_kode'] == 'RT')
                        <a href="{{ route('bansos.kriteria.form', ['id' => $dataKeluarga->no_kk]) }}"
                            class="tw-btn tw-btn-primary tw-btn-md-ilead tw-rounded-full">
                            <x-icons.actionable.edit class="" stroke="2" size="20"
                                color="n100"></x-icons.actionable.edit>
                            <span class="">
                                Perbarui
                            </span>
                        </a>
                @endif
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Kriteria Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Kepala Keluarga',
                                'content' => $dataKeluarga->kepala_keluarga,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Tagihan Listrik',
                                'content' => 'Rp ' . number_format($dataKeluarga->tagihan_listrik, 0, ',', '.'),
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Luas Bangunan',
                                'content' => $dataKeluarga->luas_bangunan . ' m²',

                            ])
                        </div>
                    </div>

                    @foreach ($dataWarga as $anggota)

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                        <h2 class="">Kriteria Anggota</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Nama',
                                'content' => $anggota->nama,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Luas Bangunan',
                                'content' => $anggota->status_keluarga,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Penghasilan',
                                'content' => 'Rp ' . number_format($anggota->penghasilan, 0, ',', '.'),
                            ])

                        </div>
                    </div>
                    @endforeach

                </div>


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
    </div>
    @if (Session::has('message'))
        <script>alert('{{Session::get('message')[1]}}')</script>
    @endif
@endsection

