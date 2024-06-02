@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10 tw-animate-fade-right tw-animate-ease-in-out tw-animate-duration-[500ms]">
        <p class="tw-breadcrumb tw-text-n500">Daftar Keluarga / Detail Keluarga /
            <span class="tw-font-bold tw-text-b500">Perbarui Data</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Perbarui Data Keluarga</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('penduduk.keluarga.update', ['no_kk' => $keluarga->no_kk]) }}"
                method="POST" id="formData" enctype="multipart/form-data">
                {{ csrf_field() }}
                {!! method_field('PUT') !!}

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Data Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3" id="identitasWarga">

                            <x-input.label for="no_kk" label="No KK">
                                <x-input.input value="{{ $keluarga->no_kk }}" type="text" id="no_kk" name="no_kk"
                                    disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_kk">No KK
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text" id="no_kk"
                                    name="no_kk" disabled>
                            </label> --}}

                            <x-input.label for="kepala_keluarga" label="Kepala Keluarga">
                                <x-input.select name="kepala_keluarga" id="kepala_keluarga">
                                    @foreach ($keluarga->warga as $warga)
                                        <option value="{{ $warga->NIK }}" @selected(old('kepala_keluarga', $keluarga->kepala_keluarga) == $warga->nama)>{{ $warga->nama }}
                                        </option>
                                    @endforeach
                                    {{-- <option value="option_1">Option 1</option>
                                    <option value="option_2">Option 2</option> --}}
                                </x-input.select>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kepala_keluarga">Kepala Keluarga
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <select class="tw-input-enabled tw-placeholder tw-appearance-none" name="kepala_keluarga" id="kepala_keluarga">
                                        <option value="option_1">Option 1</option>
                                        <option value="option_2">Option 2</option>
                                    </select>
                                    <span
                                        class="toggleDrop tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2">
                                        <img id="arrowDown" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                            alt="\/">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="alamat" label="No Alamat">
                                <x-input.input value="{{ $keluarga->alamat }}" type="text" id="alamat" name="alamat"
                                    disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="alamat">Alamat
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="alamat" name="alamat" disabled>
                            </label> --}}

                            <x-input.label for="kode_pos" label="Kode Pos">
                                <x-input.input value="{{ $keluarga->kode_pos }}" type="text" id="kode_pos"
                                    name="kode_pos" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kode_pos">Kode Pos
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="kode_pos" name="kode_pos" disabled>
                            </label> --}}

                            <x-input.label for="rt" label="RT">
                                <x-input.input value="{{ $keluarga->RT }}" type="text" id="rt" name="rt"
                                    disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="rt">RT
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="rt" name="rt" disabled>
                            </label>                             --}}

                            <x-input.label for="rw" label="RW">
                                <x-input.input value="{{ $keluarga->RW }}" type="text" id="rw" name="rw"
                                    disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="rw">RW
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="rw" name="rw" disabled>
                            </label>                             --}}

                            <x-input.label for="kelurahan" label="Kelurahan">
                                <x-input.input value="{{ $keluarga->kelurahan }}" type="text" id="kelurahan"
                                    name="kelurahan" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kelurahan">Kelurahan
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="kelurahan" name="kelurahan" disabled>
                            </label>                             --}}

                            <x-input.label for="kecamatan" label="Kecamatan">
                                <x-input.input value="{{ $keluarga->kecamatan }}" type="text" id="kecamatan"
                                    name="kecamatan" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kecamatan">Kecamatan
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="kecamatan" name="kecamatan" disabled>
                            </label>                             --}}

                            <x-input.label for="kota" label="Kota">
                                <x-input.input value="{{ $keluarga->kota }}" type="text" id="kota" name="kota"
                                    disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kota">Kota
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="kota" name="kota" disabled>
                            </label>                             --}}

                            <x-input.label for="provinsi" label="Provinsi">
                                <x-input.input value="{{ $keluarga->provinsi }}" type="text" id="provinsi"
                                    name="provinsi" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="provinsi">Provinsi
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="provinsi" name="provinsi" disabled>
                            </label>                             --}}

                            <x-input.label for="kartu_keluarga" label="Berkas Pendukung">
                                <x-input.file id="kartu_keluarga" name="kartu_keluarga"></x-input.file>
                                @error('kartu_keluarga')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="tagihan_listrik" label="Tagihan Listrik">
                                <x-input.leadingicon name="tagihan_listrik" type="number" placeholder=".0"
                                    value="{{ old('tagihan_listrik', $keluarga->tagihan_listrik) }}" icon="rupiah"
                                    alt="Rp">
                                </x-input.leadingicon>
                                @error('tagihan_listrik')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tagihan_listrik">Tagihan Listrik
                                <div class="tw-relative tw-flex tw-w-full">
                                    <input type="number" min="0" id="tagihan_listrik" name="tagihan_listrik" placeholder="HERE"
                                        value="HERE" class="tw-input-enabled tw-pl-8 tw-pr-3" type="text">
                                    </input>
                                    <span
                                        class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-cursor-pointer">
                                        <img class="tw-w-7 tw-bg-cover"
                                            src="{{ asset('assets/icons/actionable/rupiah.svg') }}" alt="Rp">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="luas_bangunan" label="Luas Bangunan">
                                <x-input.input placeholder="HERE"
                                    value="{{ old('luas_bangunan', $keluarga->luas_bangunan) }}" type="number"
                                    min="0" id="luas_bangunan" name="luas_bangunan">
                                </x-input.input>
                                @error('luas_bangunan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="luas_bangunan">Luas Bangunan
                                <input class="tw-input-enabled tw-placeholder tw-appearance-none" placeholder="HERE" value="HERE"
                                    type="number" min="0" id="luas_bangunan" name="luas_bangunan">
                            </label> --}}

                        </div>
                    </div>

                </div>


                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ route('penduduk.keluarga.detail', ['no_kk' => $keluarga->no_kk]) }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
                        type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button type="submit"
                        class="tw-btn tw-btn-primary tw-btn-lg tw-btn-round"
                        type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#status_warga').change(function() {
                const selectedStatusWarga = $(this).val();
                const fileStatusWarga =
                    '<label class="tw-label tw-flex tw-flex-col tw-gap-2" for="berkas_demografi_keluar">Berkas Pendukung <div class="tw-relative tw-cursor-pointer tw-input-enabled"> <input id="berkas_demografi_keluar" type="file" class=" tw-flex tw-py-[9px] file:tw-absolute file:tw-top-1/2 file:-tw-translate-y-1/2 file:tw-right-0 file:tw-h-full file:tw-border-y-0 file: file:tw-border-r-0 file:tw-border-l-[1.5px] file:tw-rounded-r-md file:tw-px-2 file:hover:tw-bg-n200 file:hover:tw-border-n600 file:active:tw-border-n600 file:tw-justify-center tw-cursor-pointer file:tw-cursor-pointer  file:tw-border-n400 file:tw-bg-n100 file:tw-m-0 " required> </div></label>'
                if (selectedStatusWarga !== 'Aktif' && !$('#berkas_demografi_keluar').length) {
                    $('#identitasWarga').append(fileStatusWarga);
                } else if (selectedStatusWarga === 'Aktif') {
                    $('#berkas_demografi_keluar').parent().parent().remove();
                }
            });
        });
    </script>
@endsection
