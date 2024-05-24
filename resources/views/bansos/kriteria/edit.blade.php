@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Kriteria /
            <span class="tw-font-bold tw-text-b500">Ubah Data</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Perbarui Data Kriteria</h1>

            <form class="tw-flex tw-flex-col tw-gap-7 " action="{{ route('bansos.kriteria.update', $dataKeluarga->no_kk) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Kriteria Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="kepala_keluarga" label="Kepala Keluarga">
                                <x-input.input value="" type="text" id="kepala_keluarga" name="kepala_keluarga" value="{{ $dataKeluarga->kepala_keluarga }}" disabled></x-input.input>
                            </x-input.label>

                            <x-input.label for="tagihan_listrik" label="Tagihan Listrik">
                                <x-input.leadingicon type="text" id="tagihan_listrik" name="tagihan_listrik" value="{{ old('tagihan_listrik', $dataKeluarga->tagihan_listrik) }}" icon="rupiah" alt="Rp"></x-input.leadingicon>
                                @error('tagihan_listrik')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label for="luas_bangunan" label="Luas Bangunan (m2)">
                                <x-input.input type="text" id="luas_bangunan" name="luas_bangunan"
                                value="{{ old('luas_bangunan', $dataKeluarga->luas_bangunan) }}"></x-input.input>
                                @error('luas_bangunan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                        </div>
                    </div>

                    @foreach ($dataWarga as $anggota)
                        <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                            <h2 class="">Kriteria Anggota</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">

                                <x-input.label for="nik" label="NIK">
                                    <x-input.input ype="text" id="nik" name="nik[]" value="{{ $anggota->nik }}" disabled></x-input.input>
                                </x-input.label>

                                <x-input.label for="nama" label="Nama">
                                    <x-input.input type="text" id="nama" name="nama[]" value="{{ $anggota->nama }}" disabled></x-input.input>
                                </x-input.label>

                                <x-input.label for="status_keluarga" label="Status Keluarga">
                                    <x-input.input ype="text" id="status_keluarga" name="status_keluarga[]"
                                    value="{{ $anggota->status_keluarga }}" disabled></x-input.input>
                                </x-input.label>

                                <x-input.label for="jenis_pekerjaan" label="Jenis Pekerjaan">
                                    <x-input.input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan[]"
                                    value="{{ $anggota->jenis_pekerjaan }}" disabled></x-input.input>
                                </x-input.label>

                                <x-input.label for="penghasilan" label="Penghasilan">
                                    <x-input.leadingicon type="number" id="penghasilan" name="penghasilan[{{$anggota->nik}}]"
                                    value="{{ old('penghasilan.' . $anggota->nik, $anggota->penghasilan) }}" icon="rupiah" alt="Rp"></x-input.leadingicon>
                                    @error('penghasilan.' . $anggota->nik)
                                        <small class="form-text tw-text-red-600">{{ $message }}</small>
                                    @enderror
                                </x-input.label>

                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{route('bansos.kriteria')}}"
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