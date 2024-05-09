@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Warga / Detail Warga /
            <span class="tw-font-bold tw-text-b500">Perbarui Data</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Perbarui Data Warga</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('warga-edit', ['nik'=>$warga->NIK]) }}" method="POST" id="formData" enctype="multipart/form-data">
                {{ csrf_field() }}
                {!! method_field('PUT') !!}

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Identitas Warga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3" id="identitasWarga">

                            <x-input.label for="nik" label="NIK">
                                <x-input.input value="{{ $warga->NIK }}" type="text" id="nik" name="nik" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nik">NIK
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text" id="nik"
                                    name="nik" disabled>
                            </label> --}}

                            <x-input.label for="nama" label="Nama">
                                <x-input.input value="{{ $warga->nama }}" type="text" id="nama" name="nama" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama">Nama
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text" id="nama"
                                    name="nama" disabled>
                            </label> --}}

                            <x-input.label for="tempat_lahir" label="Tempat Lahir">
                                <x-input.input value="{{ $warga->tempat_lahir }}" type="text" id="tempat_lahir" name="tempat_lahir" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tempat_lahir">Tempat Lahir
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="tempat_lahir" name="tempat_lahir" disabled>
                            </label> --}}

                            <x-input.label for="tanggal_lahir" label="Tanggal Lahir">
                                <x-input.input value="{{ $warga->tanggal_lahir }}" type="date" id="tanggal_lahir" name="tanggal_lahir" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tanggal_lahir">Tanggal Lahir
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="date"
                                    id="tanggal_lahir" name="tanggal_lahir" disabled>
                            </label> --}}

                            <x-input.label for="jenis_kelamin" label="Jenis Kelamin">
                                <x-input.input value="{{ $warga->jenis_kelamin }}" type="text" id="jenis_kelamin" name="jenis_kelamin" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis_kelamin">Jenis Kelamin
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="date"
                                    id="jenis_kelamin" name="jenis_kelamin" disabled>
                            </label> --}}

                            <x-input.label for="pendidikan" label="Pendidikan">
                                <x-input.select name="pendidikan" id="pendidikan">
                                    <option value="Tamat SD/Sederajat" @selected(old('pendidikan', $warga->pendidikan) == 'Tamat SD/Sederajat')>Tamat SD/Sederajat</option>
                                    <option value="SLTA/Sederajat" @selected(old('pendidikan', $warga->pendidikan) == 'SLTA/Sederajat')>SLTA/Sederajat</option>
                                    <option value="DIPLOMA I/II" @selected(old('pendidikan', $warga->pendidikan) == 'DIPLOMA I/II')>DIPLOMA I/II</option>
                                    <option value="Diploma IV/Strata 1" @selected(old('pendidikan', $warga->pendidikan) == 'Diploma IV/Strata 1')>Diploma IV/Strata 1</option>
                                </x-input.select>
                                @error('pendidikan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="pendidikan">Pendidikan
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <select class="tw-input-enabled tw-placeholder tw-appearance-none" name="pendidikan" id="pendidikan">
                                        <option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
                                        <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                                        <option value="DIPLOMA I/II">DIPLOMA I/II</option>
                                        <option value="Diploma IV/Strata 1">Diploma IV/Strata 1</option>
                                    </select>
                                    <span
                                        class="toggleDrop tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2">
                                        <img id="arrowDown" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                            alt="\/">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="agama" label="Agama">
                                <x-input.select name="agama" id="agama">
                                    <option value="Budha" @selected(old('agama', $warga->agama) == 'Budha')>Budha</option>
                                    <option value="Hindu" @selected(old('agama', $warga->agama) == 'Hindu')>Hindu</option>
                                    <option value="Islam" @selected(old('agama', $warga->agama) == 'Islam')>Islam</option>
                                    <option value="Katolik" @selected(old('agama', $warga->agama) == 'Katolik')>Katolik</option>
                                    <option value="Kristen" @selected(old('agama', $warga->agama) == 'Kristen')>Kristen</option>
                                    <option value="Konghuchu" @selected(old('agama', $warga->agama) == 'Konghuchu')>Konghuchu</option>
                                </x-input.select>
                                @error('agama')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="agama">Agama
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <select class="tw-input-enabled tw-placeholder tw-appearance-none" name="agama" id="agama">
                                        <option value="Budha">Budha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Konghuchu">Konghuchu</option>
                                    </select>
                                    <span
                                        class="toggleDrop tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2">
                                        <img id="arrowDown" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                            alt="\/">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="status_perkawinan" label="Status Perkawinan">
                                <x-input.select name="status_perkawinan" id="status_perkawinan">
                                    <option value="Belum Kawin" @selected(old('status_perkawinan', $warga->status_perkawinan) == 'Belum Kawin')>Belum Kawin</option>
                                    <option value="Kawin" @selected(old('status_perkawinan', $warga->status_perkawinan) == 'Kawin')>Kawin</option>
                                    <option value="Cerai Mati" @selected(old('status_perkawinan', $warga->status_perkawinan) == 'Cerai Mati')>Cerai Mati</option>
                                </x-input.select>
                                @error('status_perkawinan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="status_perkawinan">Status Perkawinan
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <select class="tw-input-enabled tw-placeholder tw-appearance-none" name="status_perkawinan"
                                    id="status_perkawinan">
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                                    <span
                                        class="toggleDrop tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2">
                                        <img id="arrowDown" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                            alt="\/">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="jenis_pekerjaan" label="Jenis Pekerjaan">
                                <x-input.select name="jenis_pekerjaan" id="jenis_pekerjaan">
                                    <option value="Belum/Tidak Bekerja" @selected(old('jenis_pekerjaan', $warga->jenis_pekerjaan) == 'Belum/Tidak Bekerja')>Belum/Tidak Bekerja</option>
                                    <option value="Karyawan Swasta" @selected(old('jenis_pekerjaan', $warga->jenis_pekerjaan) == 'Karyawan Swasta')>Karyawan Swasta</option>
                                    <option value="Mengurus Rumah Tangga" @selected(old('jenis_pekerjaan', $warga->jenis_pekerjaan) == 'Mengurus Rumah Tangga')>Mengurus Rumah Tangga</option>
                                    <option value="Pegawai Negeri Sipil" @selected(old('jenis_pekerjaan', $warga->jenis_pekerjaan) == 'Pegawai Negeri Sipil')>Pegawai Negeri Sipil</option>
                                    <option value="Pelajar/Mahasiswa" @selected(old('jenis_pekerjaan', $warga->jenis_pekerjaan) == 'Pelajar/Mahasiswa')>Pelajar/Mahasiswa</option>
                                </x-input.select>
                                @error('jenis_pekerjaan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis_pekerjaan">Jenis Pekerjaan
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <select class="tw-input-enabled tw-placeholder tw-appearance-none" name=" " id="jenis_pekerjaan">
                                        <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                                        <option value="Karyawan Swasta">Karyawan Swasta</option>
                                        <option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
                                        <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                        <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                    </select>
                                    <span
                                        class="toggleDrop tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2">
                                        <img id="arrowDown" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                            alt="\/">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="kewarganegaraan" label="Kewarganegaraan">
                                <x-input.input value="{{ $warga->kewarganegaraan}}" type="text" id="kewarganegaraan" name="kewarganegaraan" disabled></x-input.input>
                            </x-input.label>


                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kewarganegaraan">Kewarganegaraan
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="kewarganegaraan" name="kewarganegaraan" disabled>
                            </label> --}}

                            <x-input.label for="jenis_demografi_keluar" label="Status Warga">
                                @if ($demografi && $demografi->demografi->jenis == 'Meninggal')
                                    <x-input.select name="jenis_demografi_keluar" id="jenis_demografi_keluar" disabled>
                                        <option value="Meninggal" @selected($demografi && $demografi->demografi->jenis == 'Meninggal')>Meninggal</option>
                                    </x-input.select>
                                @elseif (in_array($demografi && $demografi->demografi->jenis, ['Migrasi Masuk', 'Lahir']))
                                    <x-input.select name="jenis_demografi_keluar" id="jenis_demografi_keluar">
                                        <option value="{{$demografi->demografi->jenis}}" selected>{{$demografi->demografi->jenis}} (Saat Ini)</option>
                                        <option value="Migrasi Keluar" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Migrasi Keluar')>Migrasi Keluar</option>
                                        <option value="Meninggal" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Meninggal')>Meninggal</option>
                                    </x-input.select>
                                @else
                                    <x-input.select name="jenis_demografi_keluar" id="jenis_demografi_keluar">
                                        <option value="" @selected(!$demografi)>Pilih Jenis Demografi</option>
                                        <option value="Lahir" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Lahir')>Lahir</option>
                                        <option value="Migrasi Masuk" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Migrasi Masuk')>Migrasi Masuk</option>
                                        <option value="Migrasi Keluar" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Migrasi Keluar')>Migrasi Keluar</option>
                                        <option value="Meninggal" @selected(old('jenis_demografi_keluar', $demografi ? $demografi->demografi->jenis : '') == 'Meninggal')>Meninggal</option>
                                    </x-input.select>
                                @endif
                            </x-input.label>
                            @if($errors->has('berkas_demografi_keluar') || $errors->has('tanggal_kejadian_demografi_keluar'))
                                <x-input.label for="tanggal_kejadian_demografi_keluar" label="Tanggal Kejadian">
                                    <x-input.input value="{{ old('tanggal_kejadian_demografi_keluar') }}" placeholder="" type="date"
                                        id="tanggal_kejadian_demografi_keluar" name="tanggal_kejadian_demografi_keluar"></x-input.input>
                                    @error('tanggal_kejadian_demografi_keluar')
                                        <small class="form-text tw-text-red-600">{{ $message }}</small>
                                    @enderror
                                </x-input.label>

                                <x-input.label for="berkas_demografi_keluar" label="Berkas Pendukung">
                                    <x-input.file id="berkas_demografi_keluar" name="berkas_demografi_keluar"></x-input.file>
                                    @error('berkas_demografi_keluar')
                                        <small class="form-text tw-text-red-600">{{ $message }}</small>
                                    @enderror
                                </x-input.label>
                                <div id="berkas">
                                    @if (session()->has('berkas_demografi_keluar'))
                                        @php
                                            $img = session()->get('berkas_demografi_keluar');
                                        @endphp
                                        @include('components.form.textdetail', [
                                            'title' => '',
                                            'isImage' => true,
                                            'content' => 'data:image/' . $img->ext . ';base64, ' . base64_encode(Storage::disk('temp')->get($img->path)),
                                        ])
                                    @endif
                                </div>
                            @endif

                            {{-- @error(['berkas_demografi_keluar', 'tanggal_kejadian_demografi_keluar'])
                                <x-input.label for="tanggal_kejadian_demografi_keluar" label="Tanggal Kejadian">
                                    <x-input.input value="{{ old('tanggal_kejadian_demografi_keluar') }}" placeholder="" type="date"
                                        id="tanggal_kejadian_demografi_keluar" name="tanggal_kejadian_demografi_keluar"></x-input.input>
                                    @error('tanggal_kejadian_demografi_keluar')
                                        <small class="form-text tw-text-red-600">{{ $message }}</small>
                                    @enderror
                                </x-input.label>

                                <x-input.label for="berkas_demografi_keluar" label="Berkas Pendukung">
                                    <x-input.file id="berkas_demografi_keluar" name="berkas_demografi_keluar"></x-input.file>
                                    @error('berkas_demografi_keluar')
                                        <small class="form-text tw-text-red-600">{{ $message }}</small>
                                    @enderror
                                </x-input.label>
                            @enderror --}}

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="status_warga">Status Warga
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <select class="tw-input-enabled tw-placeholder tw-appearance-none" name="status_warga" id="status_warga">
                                        <option value="Aktif" selected>Aktif</option>
                                        <option value="Migrasi">Migrasi</option>
                                        <option value="Meninggal">Meninggal</option>
                                    </select>
                                    <span
                                        class="toggleDrop tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2">
                                        <img id="arrowDown" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                            alt="\/">
                                    </span>
                                </div>
                            </label> --}}
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label for="status_keluarga" label="Status Keluarga">
                                <x-input.select name="status_keluarga" id="status_keluarga">
                                    <option value="Kepala Keluarga" @selected($warga->status_keluarga == 'Kepala Keluarga')>Kepala Keluarga</option>
                                    <option value="Istri" @selected($warga->status_keluarga == 'Istri')>Istri</option>
                                    <option value="Anak" @selected($warga->status_keluarga == 'Anak')>Anak</option>
                                </x-input.select>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="staus_keluarga">Status Keluarga
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <select class="tw-input-enabled tw-placeholde tw-appearance-none" name="status_keluarga"
                                    id="status_keluarga">
                                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                </select>
                                    <span
                                        class="toggleDrop tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2">
                                        <img id="arrowDown" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                            alt="\/">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="nama_ayah" label="Nama Ayah">
                                <x-input.input value="{{ $warga->nama_ayah }}" type="text" id="nama_ayah" name="nama_ayah" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama_ayah">Nama Ayah
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="nama_ayah" name="nama_ayah" disabled>
                            </label> --}}

                            <x-input.label for="nama_ibu" label="Nama Ibu">
                                <x-input.input value="{{ $warga->nama_ibu }}" type="text" id="nama_ibu" name="nama_ibu" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama_ibu">Nama Ibu
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="nama_ibu" name="nama_ibu" disabled>
                            </label> --}}

                            <x-input.label for="penghasilan" label="Penghasilan">
                                <x-input.leadingicon type="number" value="{{ $warga->penghasilan }}" min="0" id="penghasilan" name="penghasilan" placeholder="HERE" icon="rupiah" alt="Rp">
                                </x-input.leadingicon>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="penghasilan">Penghasilan
                                <div class="tw-relative tw-flex tw-w-full">
                                    <input type="number" min="0" id="penghasilan" name="penghasilan" placeholder="HERE"
                                        value="HERE" class="tw-input-enabled tw-pl-8 tw-pr-3" type="text">
                                    </input>
                                    <span
                                        class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-cursor-pointer">
                                        <img class="tw-w-7 tw-bg-cover"
                                            src="{{ asset('assets/icons/actionable/rupiah.svg') }}" alt="Rp">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="no_paspor" label="Nomor Paspor">
                                <x-input.input value="{{ $warga->no_paspor }}" type="text" id="no_paspor" name="no_paspor"></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_paspor">Nomor Paspor
                                <input class="tw-input-enabled tw-placeholder" placeholder="HERE" value="HERE"
                                    type="text" id="no_paspor" name="no_paspor">
                            </label> --}}

                            <x-input.label for="no_kitas" label="Nomor Kitas">
                                <x-input.input value="{{ $warga->no_kitas }}" type="text" id="no_kitas" name="no_kitas"></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_kitas">Nomor Kitas
                                <input class="tw-input-enabled tw-placeholder" placeholder="HERE" value="HERE"
                                    type="text" id="no_kitas" name="no_kitas" value=''>
                            </label> --}}
                        </div>
                    </div>
                    @if ($demografi)

                        <div id="demografiMasuk" class="tw-flex tw-flex-col tw-gap-2 tw-pt-6" style="">
                            <h2 class="">Data Demografi</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">
                                <x-input.label for="jenis_demografi" label="Jenis" style="pointer-events: none">
                                    <x-input.select type="text" id="jenis_demografi" name="jenis_demografi" >
                                        <option value="Lahir" @selected(!$demografi || ($demografi && $demografi->demografi->jenis == 'Lahir'))>Lahir</option>
                                        <option value="Migrasi Masuk" @selected($demografi && $demografi->demografi->jenis == 'Migrasi Masuk')>Migrasi Masuk</option>
                                        <option value="Migrasi Keluar" @selected($demografi && $demografi->demografi->jenis == 'Migrasi Keluar')>Migrasi Keluar</option>
                                        <option value="Meninggal" @selected($demografi && $demografi->demografi->jenis == 'Meninggal')>Meninggal</option>
                                    </x-input.select>
                                </x-input.label>

                                <x-input.label for="tanggal_kejadian" label="Tanggal Kejadian">
                                    <x-input.input value="{{ old('tanggal_kejadian', $demografi? $demografi->tanggal_kejadian : '') }}" placeholder="" type="date"
                                        id="tanggal_kejadian" name="tanggal_kejadian"></x-input.input>
                                    @error('tanggal_kejadian')
                                        <small class="form-text tw-text-red-600">{{ $message }}</small>
                                    @enderror
                                </x-input.label>

                                <x-input.label for="berkas_demografi" label="Berkas Pendukung">
                                    <x-input.file id="berkas_demografi" name="berkas_demografi"></x-input.file>
                                    @error('berkas_demografi')
                                        <small class="form-text tw-text-red-600">{{ $message }}</small>
                                    @enderror
                                </x-input.label>

                            </div>
                        </div>
                    @endif
                </div>

                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ url()->previous() }}"
                        class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
                        type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5" color="n1000"></x-icons.actionable.arrow-left>
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
            $('#jenis_demografi_keluar').change(function() {
                const selectedStatusWarga = $(this).val();
                const fileStatusWarga = `
                    <x-input.label for="berkas_demografi_keluar" label="Berkas Pendukung">
                        <x-input.file id="berkas_demografi_keluar" name="berkas_demografi_keluar"></x-input.file>
                        @error('berkas_demografi')
                            <small class="form-text tw-text-red-600">{{ $message }}</small>
                        @enderror
                    </x-input.label>`;
                const tanggalKejadian = `
                    <x-input.label for="tanggal_kejadian_demografi_keluar" label="Tanggal Kejadian">
                        <x-input.input value="{{ old('tanggal_kejadian_demografi_keluar') }}" placeholder="" type="date"
                            id="tanggal_kejadian_demografi_keluar" name="tanggal_kejadian_demografi_keluar"></x-input.input>
                        @error('tanggal_kejadian_demografi_keluar')
                            <small class="form-text tw-text-red-600">{{ $message }}</small>
                        @enderror
                    </x-input.label>
                `
                if (selectedStatusWarga !== '{{$demografi ? $demografi->demografi->jenis : ''}}' && !$('#berkas_demografi_keluar').length) {
                    $('#identitasWarga').append(tanggalKejadian);
                    $('#identitasWarga').append(fileStatusWarga);
                    $('#demografiMasuk').css('display', 'none');
                } else if(selectedStatusWarga === '{{$demografi ? $demografi->demografi->jenis : ''}}') {
                    $('#berkas_demografi_keluar').parent().parent().remove();
                    $('#tanggal_kejadian_demografi_keluar').parent().remove();
                    $('#berkas').remove();
                    $('#demografiMasuk').css('display', 'flex');
                }
            });
        });
    </script>
@endsection


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penambahan Data</title>
</head>
<body>
    <h2>Form Penambahan Data</h2>
    <form action="{{route('tambah-warga-post')}}" method="POST" id="formData">
        {{ csrf_field() }}
        <input type="hidden" name="no_kk" id="no_kk" value="{{$no_kk}}">

        <label for="jenis-data">Jenis Data</label>
        <select name="jenis-data" id="jenis-data">
            <option value="data-baru">Warga Baru</option>
            <option value="data-lama">Warga Lama</option>
        </select><br>

        <label for="nik">NIK:</label><br>
        <input type="text" id="nik" name="nik"><br>

        <label for="nik">NIK:</label><br>
        <select name="nik" id="nik-list" disabled>
            <option value="data-baru" disabled selected>Pilih Warga</option>
        </select><br>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama"><br>

        <label for="tempat_lahir">Tempat Lahir:</label><br>
        <input type="text" id="tempat_lahir" name="tempat_lahir"><br>

        <label for="tanggal_lahir">Tanggal Lahir:</label><br>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir"><br>

        <label for="jenis_kelamin">Jenis Kelamin:</label><br>
        <select id="jenis_kelamin" name="jenis_kelamin">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br>

        <label for="agama">Agama:</label><br>
        <input type="text" id="agama" name="agama"><br>

        <label for="status_perkawinan">Status Perkawinan:</label><br>
        <input type="text" id="status_perkawinan" name="status_perkawinan"><br>

        <label for="status_keluarga">Status Keluarga:</label><br>
        <input type="text" id="status_keluarga" name="status_keluarga"><br>

        <label for="status_warga">Status Warga:</label><br>
        <input type="text" id="status_warga" name="status_warga"><br>

        <label for="jenis_pekerjaan">Jenis Pekerjaan:</label><br>
        <input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan"><br>

        <label for="penghasilan">Penghasilan:</label><br>
        <input type="text" id="penghasilan" name="penghasilan"><br>

        <label for="kewarganegaraan">Kewarganegaraan:</label><br>
        <input type="text" id="kewarganegaraan" name="kewarganegaraan"><br>

        <label for="pendidikan">Pendidikan:</label><br>
        <input type="text" id="pendidikan" name="pendidikan"><br>

        <label for="no_paspor">No Paspor:</label><br>
        <input type="text" id="no_paspor" name="no_paspor"><br>

        <label for="no_kitas">No KITAS:</label><br>
        <input type="text" id="no_kitas" name="no_kitas"><br>

        <label for="nama_ayah">Nama Ayah:</label><br>
        <input type="text" id="nama_ayah" name="nama_ayah"><br>

        <label for="nama_ibu">Nama Ibu:</label><br>
        <input type="text" id="nama_ibu" name="nama_ibu"><br>

        <input type="submit" value="Submit">
        <a href="{{url()->previous()}}">Kembali</a>
    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>
</html> --}}
