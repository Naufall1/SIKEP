@extends('layout.layout', ['isForm' => false])

@section('content')
    <div id="modalReject"
        class="tw-hidden modal-menu tw-z-20 tw-animate-disolve tw-fixed insert-0 tw-bg-n1000 tw-bg-opacity-20 tw-overflow-y-auto tw-h-full tw-w-full ">
        <div
            class="tw-w-96 md:tw-w-96 tw-relative tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-bg-n100 tw-rounded-md tw-overflow-hidden tw-border-[1px] ">
            <div class="tw-flex tw-items-center tw-px-4 tw-h-14 tw-border-b-[1px]">
                <h2>Tolak Pengajuan</h2>
            </div>
            <div id="navMenus" class="tw-flex tw-gap-4 tw-w-full tw-flex-col tw-p-4">
                <form class="tw-flex tw-flex-col tw-gap-7 tw-items-end">
                    <div class="tw-flex tw-flex-col tw-gap-3 tw-w-full">

                        <x-input.label for="catatan" label="Catatan">
                            <x-input.textarea class="tw-h-32" name="catatan" placeholder="Catatan"></x-input.textarea>
                        </x-input.label>

                    </div>

                    <div class="tw-flex tw-gap-2">
                        <button href="" class="tw-btn tw-btn-text tw-btn-lg tw-btn-round" type="button"
                            id="closeModal">Batal</button>
                        <a href="" class="tw-btn tw-btn-danger tw-btn-lg tw-btn-round" type="submit">Tolak</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[754px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Data Baru /
            <span class="tw-font-bold tw-text-b500">Detail Pengajuan</span>
        </p>

        <div class="md:tw-w-full">

            <div class="tw-flex tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Pengajuan</h1>
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Informasi</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">
                            @include('components.form.textdetail', [
                                'title' => 'Jenis',
                                'content' => $pengajuan->tipe,
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status Pengajuan',
                                'content' => $pengajuan->status_request,
                                'isLabel' => true,
                            ])
                            @if ($pengajuan->status_request === 'Ditolak')
                                @include('components.form.textdetail', [
                                    'title' => 'Catatan',
                                    'content' => $pengajuan->catatan,
                                ])
                            @endif

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between">
                        <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                            <h2 class="">Detail Warga Baru</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">

                                @include('components.form.textdetail', [
                                    'title' => 'NIK',
                                    'content' => $modifiedWarga->NIK,
                                ])
                                @include('components.form.textdetail', [
                                    'title' => 'Nama',
                                    'content' => $modifiedWarga->nama,
                                ])
                                @if ($modifiedWarga->pendidikan != $currentWarga->pendidikan)
                                    @include('components.form.textdetail', [
                                        'title' => 'Pendidikan',
                                        'content' => $modifiedWarga->pendidikan,
                                    ])
                                @endif
                                @if ($modifiedWarga->agama != $currentWarga->agama)
                                    @include('components.form.textdetail', [
                                        'title' => 'Agama',
                                        'content' => $modifiedWarga->agama,
                                    ])
                                @endif
                                @if ($modifiedWarga->status_perkawinan != $currentWarga->status_perkawinan)
                                    @include('components.form.textdetail', [
                                        'title' => 'Status Perkawinan',
                                        'content' => $modifiedWarga->status_perkawinan,
                                    ])
                                @endif
                                @if ($modifiedWarga->jenis_pekerjaan != $currentWarga->jenis_pekerjaan)
                                    @include('components.form.textdetail', [
                                        'title' => 'Pekerjaan',
                                        'content' => $modifiedWarga->jenis_pekerjaan,
                                    ])
                                @endif
                                @if ($modifiedWarga->status_warga != $currentWarga->status_warga)
                                    @include('components.form.textdetail', [
                                        'title' => 'Status Warga',
                                        'content' => $modifiedWarga->status_warga,
                                        'isLabel' => true,
                                    ]) {{-- kalau label kasih value var $isLabel with true --}}
                                @endif
                            </div>
                        </div>

                        <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                            <h2 class="">Detail Warga Lama</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">

                                @include('components.form.textdetail', [
                                    'title' => 'NIK',
                                    'content' => $currentWarga->NIK,
                                ])
                                @include('components.form.textdetail', [
                                    'title' => 'Nama',
                                    'content' => $currentWarga->nama,
                                ])
                                @if ($modifiedWarga->pendidikan != $currentWarga->pendidikan)
                                    @include('components.form.textdetail', [
                                        'title' => 'Pendidikan',
                                        'content' => $currentWarga->pendidikan,
                                    ])
                                @endif
                                @if ($modifiedWarga->agama != $currentWarga->agama)
                                    @include('components.form.textdetail', [
                                        'title' => 'Agama',
                                        'content' => $currentWarga->agama,
                                    ])
                                @endif
                                @if ($modifiedWarga->status_perkawinan != $currentWarga->status_perkawinan)
                                    @include('components.form.textdetail', [
                                        'title' => 'Status Perkawinan',
                                        'content' => $currentWarga->status_perkawinan,
                                    ])
                                @endif
                                @if ($modifiedWarga->jenis_pekerjaan != $currentWarga->jenis_pekerjaan)
                                    @include('components.form.textdetail', [
                                        'title' => 'Pekerjaan',
                                        'content' => $currentWarga->jenis_pekerjaan,
                                    ])
                                @endif
                                @if ($modifiedWarga->status_warga != $currentWarga->status_warga)
                                    @include('components.form.textdetail', [
                                        'title' => 'Status Warga',
                                        'content' => $currentWarga->status_warga,
                                        'isLabel' => true,
                                    ]) {{-- kalau label kasih value var $isLabel with true --}}
                                @endif
                            </div>
                        </div>

                    </div>

                    @if (($modifiedWarga->status_keluarga != $currentWarga->status_keluarga) || ($modifiedWarga->penghasilan != $currentWarga->penghasilan) || ($modifiedWarga->no_paspor != $currentWarga->no_paspor) || ($modifiedWarga->no_kitas != $currentWarga->no_kitas))
                        <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between">
                            <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                                <h2 class="">Detail Tambahan Baru</h2>
                                <div class="tw-flex tw-flex-col tw-gap-3">
                                    @if ($modifiedWarga->status_keluarga != $currentWarga->status_keluarga)
                                        @include('components.form.textdetail', [
                                            'title' => 'Status Keluarga',
                                            'content' => $modifiedWarga->status_keluarga,
                                        ])
                                    @endif
                                    @if ($modifiedWarga->penghasilan != $currentWarga->penghasilan)
                                        @include('components.form.textdetail', [
                                            'title' => 'Penghasilan',
                                            'content' => $modifiedWarga->penghasilan,
                                        ])
                                    @endif
                                    @if ($modifiedWarga->no_paspor != $currentWarga->no_paspor)
                                        @include('components.form.textdetail', [
                                            'title' => 'Nomor Paspor',
                                            'content' => $modifiedWarga->no_paspor,
                                        ])
                                    @endif
                                    @if ($modifiedWarga->no_kitas != $currentWarga->no_kitas)
                                        @include('components.form.textdetail', [
                                            'title' => 'Nomor Kitas',
                                            'content' => $modifiedWarga->no_kitas,
                                        ])
                                    @endif
                                </div>
                            </div>

                            <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                                <h2 class="">Detail Tambahan Lama</h2>
                                <div class="tw-flex tw-flex-col tw-gap-3">
                                    @if ($modifiedWarga->status_keluarga != $currentWarga->status_keluarga)
                                    @include('components.form.textdetail', [
                                        'title' => 'Status Keluarga',
                                        'content' => $currentWarga->status_keluarga,
                                        ])
                                    @endif
                                    @if ($modifiedWarga->penghasilan != $currentWarga->penghasilan)
                                        @include('components.form.textdetail', [
                                            'title' => 'Penghasilan',
                                            'content' => $currentWarga->penghasilan,
                                        ])
                                    @endif
                                    @if ($modifiedWarga->no_paspor != $currentWarga->no_paspor)
                                        @include('components.form.textdetail', [
                                            'title' => 'Nomor Paspor',
                                            'content' => $currentWarga->no_paspor,
                                        ])
                                    @endif
                                    @if ($modifiedWarga->no_kitas != $currentWarga->no_kitas)
                                        @include('components.form.textdetail', [
                                            'title' => 'Nomor Kitas',
                                            'content' => $currentWarga->no_kitas,
                                        ])
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endif

                    @if ($demografiMasukNew)
                        <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between">
                            <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                                @if ($demografiMasukNew)
                                    <h2 class="">Demografi Masuk Baru</h2>
                                    <div class="tw-flex tw-flex-col tw-gap-3">
                                        @include('components.form.textdetail', [
                                            'title' => 'Jenis',
                                            'content' => $demografiMasukNew->demografi->jenis,
                                        ])
                                        @include('components.form.textdetail', [
                                            'title' => 'Tanggal Kejadian',
                                            'content' => $demografiMasukNew->tanggal_kejadian,
                                        ])
                                        @include('components.form.textdetail', [
                                            'isImage' => true,
                                            'title' => 'Berkas Pendukung',
                                            'content' =>
                                                'data:image/' .
                                                explode('.', $demografiMasukNew->dokumen_pendukung)[1] .
                                                ';base64, ' .
                                                base64_encode(Storage::disk('temp')->get(
                                                        $demografiMasukNew->dokumen_pendukung)),
                                        ]) {{-- kalau label kasih value var $isLabel with true --}}
                                    </div>
                                @endif
                            </div>

                            <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                                @if ($demografiMasukOld)
                                    <h2 class="">Demografi Masuk Lama</h2>
                                    <div class="tw-flex tw-flex-col tw-gap-3">
                                        @include('components.form.textdetail', [
                                            'title' => 'Jenis',
                                            'content' => $demografiMasukOld->demografi->jenis,
                                        ])
                                        @include('components.form.textdetail', [
                                            'title' => 'Tanggal Kejadian',
                                            'content' => $demografiMasukOld->tanggal_kejadian,
                                        ])
                                        @include('components.form.textdetail', [
                                            'isImage' => true,
                                            'title' => 'Berkas Pendukung',
                                            'content' =>
                                                'data:image/' .
                                                explode('.', $demografiMasukOld->dokumen_pendukung)[1] .
                                                ';base64, ' .
                                                base64_encode(Storage::disk('temp')->get(
                                                        $demografiMasukOld->dokumen_pendukung)),
                                        ]) {{-- kalau label kasih value var $isLabel with true --}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($demografiKeluarNew)
                        <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between">
                            <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                                @if ($demografiKeluarNew)
                                    <h2 class="">Demografi Keluar Baru</h2>
                                    <div class="tw-flex tw-flex-col tw-gap-3">
                                        @include('components.form.textdetail', [
                                            'title' => 'Jenis',
                                            'content' => $demografiKeluarNew->demografi->jenis,
                                        ])
                                        @include('components.form.textdetail', [
                                            'title' => 'Tanggal Kejadian',
                                            'content' => $demografiKeluarNew->tanggal_kejadian,
                                        ])
                                        @include('components.form.textdetail', [
                                            'isImage' => true,
                                            'title' => 'Berkas Pendukung',
                                            'content' =>
                                                'data:image/' .
                                                explode('.', $demografiKeluarNew->dokumen_pendukung)[1] .
                                                ';base64, ' .
                                                base64_encode(Storage::disk('temp')->get(
                                                        $demografiKeluarNew->dokumen_pendukung)),
                                        ]) {{-- kalau label kasih value var $isLabel with true --}}
                                    </div>
                                @endif
                            </div>
                            <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-2 md:tw-w-[358px]">
                                @if ($demografiKeluarOld)
                                    <h2 class="">Demografi Keluar Lama</h2>
                                    <div class="tw-flex tw-flex-col tw-gap-3">
                                        @include('components.form.textdetail', [
                                            'title' => 'Jenis',
                                            'content' => $demografiKeluarOld->demografi->jenis,
                                        ])
                                        @include('components.form.textdetail', [
                                            'title' => 'Tanggal Kejadian',
                                            'content' => $demografiKeluarOld->tanggal_kejadian,
                                        ])
                                        @include('components.form.textdetail', [
                                            'isImage' => true,
                                            'title' => 'Berkas Pendukung',
                                            'content' =>
                                                'data:image/' .
                                                explode('.', $demografiKeluarOld->dokumen_pendukung)[1] .
                                                ';base64, ' .
                                                base64_encode(Storage::disk('temp')->get(
                                                        $demografiKeluarOld->dokumen_pendukung)),
                                        ]) {{-- kalau label kasih value var $isLabel with true --}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>


                <div class="tw-flex tw-justify-between">
                    <a href="#" onclick="history.back()" class="tw-btn tw-btn-outline tw-btn-lg-ilead tw-btn-round"
                        type="button">
                        <x-icons.actionable.arrow-left class="tw-btn-i-lead-lg" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    @if ($user == 1 && $pengajuan->status_request == 'Menunggu')
                        <div class="tw-flex tw-gap-2">
                            <button href="" class="tw-btn tw-btn-text tw-btn-lg tw-btn-round" type="button"
                                id="buttonReject">Tolak</button>
                            {{-- <a href="" class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round" type="submit">Konfirmasi</a> --}}
                            <form class="d-inline-block" method="POST"
                                action="{{ route('pengajuan.confirm.perubahan.warga') }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="id" value="{{ $pengajuan->id }}">
                                <button type="submit" class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round"
                                    onclick="return confirm('Apakah Anda yakin melakukan konfirmasi data ini?');">Konfirmasi</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#buttonReject").click(function() {
                $("#modalReject").removeClass("tw-hidden");
                $('html, body').css({
                    overflow: 'hidden',
                });
            });
            $("#modalReject, #closeModal").click(function() {
                $("#modalReject").addClass("tw-hidden");
                $('html, body').css({
                    overflow: 'auto',
                });
            });
        });
    </script>
@endsection
