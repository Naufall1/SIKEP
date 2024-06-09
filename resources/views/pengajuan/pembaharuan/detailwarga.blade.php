@extends('layout.layout', ['isForm' => false])

@section('content')
{{-- {{dd(Storage::disk('public')->get('Dokumen-Pendukung/'.'1f5cc54a0573476d9587bb0ab3fc263e.png'))}} --}}
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Data Baru / Detail Pengajuan /
            <span class="tw-font-bold tw-text-b500">Detail Anggota</span>
        </p>

        <div class="md:tw-w-fit">

            <div class="tw-flex tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Anggota Keluarga</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Identitas</h2>
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

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
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
                                'content' => 'Rp ' . number_format( $warga->penghasilan, 0, ",", "."),

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

                    @if (!is_null($haveDemografi))
                        <div class="tw-flex tw-flex-col md:tw-flex-row md:tw-justify-between">
                            <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                                <h2 class="">Demografi Masuk</h2>
                                <div class="tw-flex tw-flex-col tw-gap-3">
                                    @include('components.form.textdetail', [
                                        'title' => 'Jenis',
                                        'content' => $haveDemografi->demografi->jenis ?? $demografi->jenis,
                                    ])
                                    @include('components.form.textdetail', [
                                        'title' => 'Tanggal',
                                        'content' => $haveDemografi->tanggal_kejadian,
                                    ])
                                    @include('components.form.textdetail', [
                                        'isImage' => true,
                                        'title' => 'Berkas Pendukung',
                                        'content' =>
                                                !is_null(Storage::disk('public')->get('Dokumen-Pendukung/'. $haveDemografi->dokumen_pendukung)) ?
                                                asset(Storage::disk('public')->url('Dokumen-Pendukung/' . $haveDemografi->dokumen_pendukung)) :
                                                'data:image/' .
                                                    explode('.', $haveDemografi->dokumen_pendukung)[1] .
                                                    ';base64, ' .
                                                    base64_encode(Storage::disk('temp')->get(
                                                            $haveDemografi->dokumen_pendukung)),
                                    ]) {{-- kalau label kasih value var $isLabel with true --}}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>


                <div class="tw-flex">
                    <a href="{{isset($id) ? route('pengajuan.pembaharuan',['id'=>$id]) : route('keluarga-tambah')}}" class="tw-btn tw-btn-outline tw-btn-lg-ilead tw-btn-round" type="button">
                        <x-icons.actionable.arrow-left class="tw-btn-i-lead-lg" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
