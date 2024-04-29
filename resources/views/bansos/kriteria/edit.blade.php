@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Kriteria /
            <span class="tw-font-bold tw-text-b500">Ubah Data</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Perbarui Data Kriteria</h1>

            <form class="tw-flex tw-flex-col tw-gap-7 " action="{{ route('kriteriaUpdate', $dataKeluarga->no_kk) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Kriteria Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="kepala_keluarga" label="Kepala Keluarga">
                                <x-input.input value="HERE" type="text" id="kepala_keluarga" name="kepala_keluarga" value="{{ $dataKeluarga->kepala_keluarga }}" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kepala_keluarga">Kepala Keluarga
                                <input type="text" id="kepala_keluarga" name="kepala_keluarga"
                                    value="{{ $dataKeluarga->kepala_keluarga }}" readonly class="tw-input-disabled">
                            </label> --}}

                            <x-input.label for="tagihan_listrik" label="Tagihan Listrik">
                                <x-input.leadingicon type="text" id="tagihan_listrik" name="tagihan_listrik" value="{{ $dataKeluarga->tagihan_listrik }}" icon="rupiah" alt="Rp"></x-input.leadingicon>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tagihan_listrik">Tagihan Listrik
                                <div class="tw-relative tw-flex tw-w-full tw-grid-rows-3">
                                    <input type="text" id="tagihan_listrik" name="tagihan_listrik"
                                        value="{{ $dataKeluarga->tagihan_listrik }}"
                                        class="tw-input-enabled md:tw-w-80 tw-h-11 tw-pl-8 tw-pr-3 tw-bg-n100 tw-border-[1.5px]"
                                        type="text">
                                    </input>
                                    <span
                                        class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-cursor-pointer">
                                        <img class="tw-w-7 tw-bg-cover"
                                            src="{{ asset('assets/icons/actionable/rupiah.svg') }}" alt="Rp">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="luas_bangunan" label="Luas Bangunan (m2)">
                                <x-input.input type="text" id="luas_bangunan" name="luas_bangunan"
                                value="{{ $dataKeluarga->luas_bangunan }}"></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="luas_bangunan">Luas Bangunan (m2)
                                <input type="text" id="luas_bangunan" name="luas_bangunan"
                                    value="{{ $dataKeluarga->luas_bangunan }}" class="tw-input-enabled">
                            </label> --}}
                        </div>
                    </div>

                    @foreach ($dataWarga as $anggota)
                        <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                            <h2 class="">Kriteria Anggota</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">

                                <x-input.label for="nik" label="NIK">
                                    <x-input.input ype="text" id="nik" name="nik[]" value="{{ $anggota->nik }}" disabled></x-input.input>
                                </x-input.label>

                                {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nik">NIK
                                    <input type="text" id="nik" name="nik[]" value="{{ $anggota->nik }}" readonly
                                        class="tw-input-disabled">
                                </label> --}}

                                <x-input.label for="nama" label="Nama">
                                    <x-input.input type="text" id="nama" name="nama[]" value="{{ $anggota->nama }}" disabled></x-input.input>
                                </x-input.label>

                                {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama">Nama
                                    <input type="text" id="nama" name="nama[]" value="{{ $anggota->nama }}"
                                        readonly class="tw-input-disabled">
                                </label> --}}

                                <x-input.label for="status_keluarga" label="Status Keluarga">
                                    <x-input.input ype="text" id="status_keluarga" name="status_keluarga[]"
                                    value="{{ $anggota->status_keluarga }}" disabled></x-input.input>
                                </x-input.label>

                                {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="status_keluarga">Status Keluarga
                                    <input type="text" id="status_keluarga" name="status_keluarga[]"
                                        value="{{ $anggota->status_keluarga }}" readonly class="tw-input-disabled">
                                </label> --}}

                                <x-input.label for="jenis_pekerjaan" label="Jenis Pekerjaan">
                                    <x-input.input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan[]"
                                    value="{{ $anggota->jenis_pekerjaan }}" disabled></x-input.input>
                                </x-input.label>

                                {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis_pekerjaan">Jenis Pekerjaan
                                    <input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan[]"
                                        value="{{ $anggota->jenis_pekerjaan }}" readonly class="tw-input-disabled">
                                </label> --}}

                                <x-input.label for="penghasilan" label="Penghasilan">
                                    <x-input.leadingicon type="text" id="penghasilan" name="penghasilan[]"
                                    value="{{ $anggota->penghasilan }}" icon="rupiah" alt="Rp"></x-input.leadingicon>
                                </x-input.label>

                                {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="penghasilan">Penghasilan
                                    <div class="tw-relative tw-flex tw-w-full tw-grid-rows-3">
                                        <input type="text" id="penghasilan" name="penghasilan[]"
                                            value="{{ $anggota->penghasilan }}"
                                            class="tw-input-enabled md:tw-w-80 tw-h-11 tw-pl-8 tw-pr-3 tw-bg-n100 tw-border-[1.5px]"
                                            type="text">
                                        </input>
                                        <span
                                            class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-cursor-pointer">
                                            <img class="tw-w-7 tw-bg-cover"
                                                src="{{ asset('assets/icons/actionable/rupiah.svg') }}" alt="Rp">
                                        </span>
                                    </div>
                                </label> --}}
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{route('kriteria')}}"
                        class="tw-btn tw-btn-outline tw-btn-lg-ilead tw-btn-round"
                        type="button">
                        <x-icons.actionable.arrow-left class="tw-btn-i-lead-lg" stroke="1.5" color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button
                        class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round"
                        type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection
{{-- <!DOCTYPE html>
            <html>
                <head>
                    <title>Edit Kriteria</title>
                </head>
                <body>
                    <h1>Kriteria Keluarga</h1>
                    <form action="{{ route('kriteriaUpdate', $dataKeluarga->no_kk) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="kepala_keluarga">Kepala Keluarga:</label>
        <input type="text" id="kepala_keluarga" name="kepala_keluarga" value="{{ $dataKeluarga->kepala_keluarga }}" disabled><br><br>

        <label for="tagihan_listrik">Tagihan Listrik:</label>
        <input type="text" id="tagihan_listrik" name="tagihan_listrik" value="{{ $dataKeluarga->tagihan_listrik }}"><br><br>

        <label for="luas_bangunan">Luas Bangunan:</label>
        <input type="text" id="luas_bangunan" name="luas_bangunan" value="{{ $dataKeluarga->luas_bangunan }}"><br><br>

        <h1>Kriteria Anggota Keluarga</h1>
        @foreach ($dataWarga as $anggota)
            <label for="nik">NIK:</label>
            kalo ga readonly error y sayang
            <input type="text" id="nik" name="nik[]" value="{{ $anggota->nik }}" readonly><br><br>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama[]" value="{{ $anggota->nama }}" readonly><br><br>

            <label for="status_keluarga">Status Keluarga:</label>
            <input type="text" id="status_keluarga" name="status_keluarga[]" value="{{ $anggota->status_keluarga }}" readonly><br><br>

            <label for="jenis_pekerjaan">Jenis Pekerjaan:</label>
            <input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan[]" value="{{ $anggota->jenis_pekerjaan }}"><br><br>

            <label for="penghasilan">Penghasilan:</label>
            <input type="text" id="penghasilan" name="penghasilan[]" value="{{ $anggota->penghasilan }}"><br><br>

            <h5>----------------------</h5>
        @endforeach

        <button type="submit">Simpan</button>
    </form>
</body>
</html> --}}
