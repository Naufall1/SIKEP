@extends('layout.layout', ['isForm' => false])

@section('content')
    <div
        class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">

        <x-flash-message.information message='halo'></x-flash-message.information>

        <p class="tw-breadcrumb tw-text-n500">Daftar Warga /
            <span class="tw-font-bold tw-text-b500">Detail Warga</span>
        </p>

        <div class="md:tw-w-full">

            <div
                class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RT' ? 'tw-justify-between' : '' }}  tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Data Warga</h1>
                @if (Auth::user()->hasLevel['level_kode'] == 'RT')
                    @if (!$pengajuanInProgres)
                        <a href="{{ route('warga-edit', ['nik' => $warga->NIK]) }}"
                            class="tw-btn tw-btn-primary tw-btn-md-ilead tw-rounded-full">
                            <x-icons.actionable.edit class="" stroke="2" size="20"
                                color="n100"></x-icons.actionable.edit>
                            <span class="">
                                Perbarui
                            </span>
                        </a>
                    @else
                        <button disabled class="tw-btn tw-btn-disabled tw-btn-md-ilead tw-rounded-full">
                            <x-icons.actionable.edit class="" stroke="2" size="20"
                                color="n100"></x-icons.actionable.edit>
                            <span class="">
                                Perbarui
                            </span>
                        </button>
                    @endif
                @endif
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div
                        class="tw-flex tw-flex-col tw-gap-2 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[200ms]">
                        <h2 class="">Detail Warga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">
                            @include('components.form.textdetail', [
                                'title' => 'NIK',
                                'content' => $warga->NIK,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nama',
                                'content' => $warga->nama,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Tempat Lahir',
                                'content' => $warga->tempat_lahir,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Tanggal Lahir',
                                'content' => $warga->tanggal_lahir,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Jenis Kelamin',
                                'content' => $warga->jenis_kelamin,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Pendidikan',
                                'content' => $warga->pendidikan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Agama',
                                'content' => $warga->agama,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status Perkawinan',
                                'content' => $warga->status_perkawinan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Pekerjaan',
                                'content' => $warga->jenis_pekerjaan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kewarganegaraan',
                                'content' => $warga->kewarganegaraan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status Warga',
                                'content' => $warga->status_warga,
                                'isLabel' => true,
                            ]) {{-- kalau label kasih value var $isLabel with true --}}

                        </div>
                    </div>

                    <div
                        class="tw-flex tw-flex-col tw-gap-2 tw-pt-6 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[400ms]">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Status Keluarga',
                                'content' => $warga->status_keluarga,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nama Ayah',
                                'content' => $warga->nama_ayah,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nama Ibu',
                                'content' => $warga->nama_ibu,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Penghasilan',
                                'content' => 'Rp ' . $warga->penghasilan,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nomor Paspor',
                                'content' => $warga->no_paspor,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nomor Kitas',
                                'content' => $warga->no_kitas,
                            ])

                        </div>
                    </div>

                    @if ($demografiMasuk || $demografiKeluar)
                        <div
                            class="tw-flex tw-flex-col md:tw-flex-row md:tw-justify-between tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[600ms]">

                            @if ($demografiMasuk)
                                <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                                    <h2 class="">Demografi Masuk</h2>
                                    <div class="tw-flex tw-flex-col tw-gap-3">
                                        @include('components.form.textdetail', [
                                            'title' => 'Jenis',
                                            'content' => !isset($warga->haveDemografi[0]->demografi)
                                                ? '-'
                                                : $warga->haveDemografi[0]->demografi->jenis,
                                        ])
                                        @include('components.form.textdetail', [
                                            'title' => 'Tanggal',
                                            'content' => !isset($warga->haveDemografi[0]->tanggal_kejadian)
                                                ? '-'
                                                : $warga->haveDemografi[0]->tanggal_kejadian,
                                        ])
                                        @include('components.form.textdetail', [
                                            'isImage' => true,
                                            'title' => 'Berkas Pendukung',
                                            'content' => !isset($warga->haveDemografi[0]->dokumen_pendukung)
                                                ? ''
                                                : asset(Storage::disk('public')->url(
                                                        'Dokumen-Pendukung/' .
                                                            $warga->haveDemografi[0]->dokumen_pendukung)),
                                        ]) {{-- kalau label kasih value var $isLabel with true --}}
                                    </div>
                                </div>
                            @endif


                            {{-- if user status user migrasi/meninggal --}}

                            @if ($demografiKeluar)
                                <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                                    <h2 class="">Demografi Keluar</h2>
                                    <div class="tw-flex tw-flex-col tw-gap-3">
                                        @include('components.form.textdetail', [
                                            'title' => 'Jenis',
                                            'content' => !isset($demografiKeluar->demografi)
                                                ? '-'
                                                : $demografiKeluar->demografi->jenis,
                                        ])
                                        @include('components.form.textdetail', [
                                            'title' => 'Tanggal',
                                            'content' => !isset($demografiKeluar->tanggal_kejadian)
                                                ? '-'
                                                : $demografiKeluar->tanggal_kejadian,
                                        ])
                                        @include('components.form.textdetail', [
                                            'isImage' => true,
                                            'title' => 'Berkas Pendukung',
                                            'content' => !isset($demografiKeluar->dokumen_pendukung)
                                                ? ''
                                                : asset(Storage::disk('public')->url(
                                                        'Dokumen-Pendukung/' .
                                                            $demografiKeluar->dokumen_pendukung)),
                                        ]) {{-- kalau label kasih value var $isLabel with true --}}
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endif


                    <div
                        class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-overflow-x-auto tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[800ms]">
                        <h2 class="">Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3 tw-w-[702px] md:tw-w-full">

                            <table class="tw-w-full tw-table-fixed">
                                {{-- <thead class="tw-rounded-lg"> --}}
                                <thead>
                                    <tr class="tw-h-11 tw-w-full tw-flex tw-bg-n300 tw-rounded-lg">
                                        {{-- <th class="">No</th> --}}
                                        <th class="">No KK</th>
                                        <th class="">Kepala Keluarga</th>
                                        <th class="tw-w-[76px]">RT</th>
                                        <th class="tw-w-[108px]"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="tw-h-16 tw-w-full tw-flex hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                        {{-- <td></td> --}}
                                        <td class="">{{ $warga->keluarga->no_kk }}</td>
                                        <td class="">{{ $warga->keluarga->kepala_keluarga }}</td>
                                        <td class="tw-w-[76px]">RT {{ $warga->keluarga->RT > 10 ? '0' . $warga->keluarga->RT : '00' . $warga->keluarga->RT}}</td>
                                        <td class="tw-w-[108px] tw-h-16 tw-flex tw-items-center tw-justify-center tw-gap-2">
                                            <a href="{{ route('penduduk.keluarga.detail', ['no_kk' => $warga->keluarga->no_kk]) }}"
                                                class="tw-btn tw-btn-md tw-btn-round-md tw-btn-primary">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                <div
                    class="tw-flex tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[600ms] tw-animate-delay-[1000ms]">
                    <a href="{{ route('penduduk.warga') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
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
        <script>
            alert('{{ Session::get('message') }}');
        </script>
    @endif

@endsection
