@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Penduduk / Tambah Keluarga /
            <span class="tw-font-bold tw-text-b500">Tambah Anggota</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Tambah Data</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('tambah-warga-post') }}" method="POST" id="formData"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Identitas Warga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <input type="hidden" name="no_kk" id="no_kk" value="{{ $no_kk }}">

                            <x-input.label required class="tw-relative" for="jenis_data-list" label="Jenis Data">
                                <x-input.select2 name="jenis_data" default="Data Baru"
                                    placeholder="Pilih Jenis Data"></x-input.select2>
                            </x-input.label>

                            {{-- <x-input.label for="jenis-data" label="Jenis Data">
                                <x-input.select name="jenis-data">
                                    <option value="data-baru">Warga Baru</option>
                                    <option value="data-lama">Warga Lama</option>
                                </x-input.select>
                            </x-input.label> --}}

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis-data">Jenis Data
                                <select class="tw-input-enabled" name="jenis-data" id="jenis-data">
                                    <option value="data-baru">Warga Baru</option>
                                    <option value="data-lama">Warga Lama</option>
                                </select>
                            </label> --}}

                            <x-input.label class="tw-relative" for="nik" label="NIK">
                                <x-input.input maxlength=16 value="{{ old('NIK') }}" type="text" name="NIK"
                                    placeholder="Masukkan NIK"></x-input.input>
                                {{-- <x-input.select class="tw-hidden" name="NIK" id="nik-list">
                                    <option value="no" disabled selected>
                                        {{ $daftarWarga->count() == 0 ? 'Tidak ada data' : 'Pilih NIK' }}</option>
                                    @foreach ($daftarWarga as $warga)
                                        <option value="{{ $warga->NIK }}">{{ $warga->NIK . ' - ' . $warga->nama }}
                                        </option>
                                    @endforeach
                                </x-input.select> --}}
                                @error('NIK')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <x-input.label class="tw-relative" for="nik" label="NIK">
                                <x-input.select2 name="nik" searchable
                                    placeholder="Pilih Jenis Pekerjaan"></x-input.select2>

                                @error('jenis_pekerjaan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label> --}}

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nik">NIK
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan NIK" type="text"
                                    id="nik" name="nik">
                                <select class="tw-hidden tw-placeholder" name="nik" id="nik-list" disabled>
                                    <option value="data-baru" disabled selected>Pilih Warga</option>
                                </select>
                            </label> --}}

                            <x-input.label for="nama" label="Nama">
                                <x-input.input value="{{ old('nama') }}" type="text" name="nama" id="nama"
                                    placeholder="Masukkan Nama"></x-input.input>
                                @error('nama')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama">Nama
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nama" type="text"
                                    id="nama" name="nama">
                            </label> --}}

                            <x-input.label for="tempat_lahir" label="Tempat Lahir">
                                <x-input.input value="{{ old('tempat_lahir') }}" type="text"
                                    placeholder="Masukkan Tempat Lahir" id="tempat_lahir"
                                    name="tempat_lahir"></x-input.input>
                                @error('tempat_lahir')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tempat_lahir">Tempat Lahir
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Tempat Lahir"
                                    type="text" id="tempat_lahir" name="tempat_lahir">
                            </label> --}}

                            <x-input.label for="tanggal_lahir" label="Tanggal Lahir">
                                <x-input.input value="{{ old('tanggal_lahir') }}" placeholder="Masukkan Tempat Lahir"
                                    type="date" id="tanggal_lahir" name="tanggal_lahir"></x-input.input>
                                @error('tanggal_lahir')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tanggal_lahir">Tanggal Lahir
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Tempat Lahir"
                                    type="date" id="tanggal_lahir" name="tanggal_lahir">
                            </label> --}}

                            <x-input.label class="tw-relative" for="jenis_kelamin-list" label="Jenis Kelamin">
                                <x-input.select2 name="jenis_kelamin"
                                    default="{{ old('jenis_kelamin') == 'L' ? 'Laki-laki' : (old('jenis_kelamin') == 'P' ? 'Perempuan' : 'Pilih Jenis Kelamin') }}"
                                    placeholder="Pilih Jenis Kelamin"></x-input.select2>
                                {{-- <x-input.select name="jenis_kelamin" id="jenis_kelamin">
                                    <option disabled @selected(!old('jenis_kelamin'))>Pilih Jenis Kelamin</option>
                                    <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                                    <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
                                </x-input.select> --}}
                                @error('jenis_kelamin')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis_kelamin">Jenis Kelamin
                                <select class="tw-input-enabled tw-placeholder" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </label> --}}

                            <x-input.label class="tw-relative" for="pendidikan-list" label="Pendidikan">
                                <x-input.select2 searchable name="pendidikan"
                                    default="{{ old('pendidikan') ? old('pendidikan') : 'Pilih Pendidikan' }}"
                                    placeholder="Pilih Pendidikan"></x-input.select2>
                                {{-- <x-input.select name="pendidikan" id="pendidikan">
                                    <option disabled @selected(!old('pendidikan'))>Pilih Pendidikan</option>
                                    <option value="Tamat SD/Sederajat" @selected(old('pendidikan') == 'Tamat SD/Sederajat')>Tamat SD/Sederajat
                                    </option>
                                    <option value="SLTA/Sederajat" @selected(old('pendidikan') == 'SLTA/Sederajat')>SLTA/Sederajat</option>
                                    <option value="DIPLOMA I/II" @selected(old('pendidikan') == 'DIPLOMA I/II')>DIPLOMA I/II</option>
                                    <option value="Diploma IV/Strata 1" @selected(old('pendidikan') == 'Diploma IV/Strata 1')>Diploma IV/Strata 1
                                    </option>
                                </x-input.select> --}}
                                @error('pendidikan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="pendidikan">Pendidikan
                                <select class="tw-input-enabled tw-placeholder" name="pendidikan" id="pendidikan">
                                    <option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
                                    <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                                    <option value="DIPLOMA I/II">DIPLOMA I/II</option>
                                    <option value="Diploma IV/Strata 1">Diploma IV/Strata 1</option>
                                </select>
                            </label> --}}

                            <x-input.label class="tw-relative" for="agama-list" label="Agama">
                                <x-input.select2 name="agama" default="{{ old('agama') ? old('agama') : 'Pilih Agama' }}"
                                    placeholder="Pilih Agama"></x-input.select2>
                                {{-- <x-input.select name="agama" id="agama">
                                    <option disabled @selected(!old('agama'))>Pilih Agama</option>
                                    <option value="Buddha" @selected(old('agama') == 'Buddha')>Budha</option>
                                    <option value="Hindu" @selected(old('agama') == 'Hindu')>Hindu</option>
                                    <option value="Islam" @selected(old('agama') == 'Islam')>Islam</option>
                                    <option value="Katolik" @selected(old('agama') == 'Katolik')>Katolik</option>
                                    <option value="Kristen" @selected(old('agama') == 'Kristen')>Kristen</option>
                                    <option value="Konghuchu" @selected(old('agama') == 'Konghuchu')>Konghuchu</option>
                                </x-input.select> --}}
                                @error('agama')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-opacity-100 tw-flex tw-flex-col tw-gap-2" for="agama">Agama
                                <select class="tw-input-enabled tw-placeholder" name="agama" id="agama">
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Konghuchu">Konghuchu</option>
                                </select>
                            </label> --}}



                            <x-input.label class="tw-relative" for="status_perkawinan-list" label="Status Perkawinan">
                                <x-input.select2 name="status_perkawinan"
                                    default="{{ old('status_perkawinan') ? old('status_perkawinan') : 'Pilih Status Perkawinan' }}"
                                    placeholder="Pilih Status Perkawinan"></x-input.select2>

                                @error('status_perkawinan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label class="tw-relative" for="jenis_pekerjaan-list" label="Jenis Pekerjaan">
                                <x-input.select2 name="jenis_pekerjaan" searchable
                                    default="{{ old('jenis_pekerjaan') ? old('jenis_pekerjaan') : 'Pilih Jenis Pekerjaan' }}"
                                    placeholder="Pilih Jenis Pekerjaan"></x-input.select2>

                                @error('jenis_pekerjaan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <x-input.label class="tw-relative tw-max-h-20" for="pendidikan" label="pendidikan">
                                <button type="button" id="pendidikan"
                                    class="dropdownTrigger tw-cursor-pointer tw-input-enabled tw-flex tw-items-center  tw-justify-between">
                                    Pilih Jenis Pekerjaan
                                    <x-icons.actionable.arrow-down-1 stroke="1.5"
                                        color="n1000"></x-icons.actionable.arrow-down-1>
                                </button>
                                <div
                                    class="dropContent tw-hidden tw-absolute tw-flex tw-flex-col tw-gap-3 tw-top-20 tw-z-10 tw-p-3 tw-w-full tw-bg-n100 tw-rounded-lg tw-border-[1.5px] tw-border-n400">
                                    <x-input.leadicon type="text" name="searchDropItem">
                                        <x-icons.actionable.search color="n1000" size="20"
                                            stroke="1.5"></x-icons.actionable.search>
                                    </x-input.leadicon>
                                    <ul class="dropOptions tw-w-full">

                                    </ul>
                                </div>
                            </x-input.label> --}}

                            {{-- <x-input.label for="jenis_pekerjaan" label="Jenis Pekerjaan">
                                <x-input.select name="jenis_pekerjaan" id="jenis_pekerjaan">
                                    <option disabled @selected(!old('jenis_pekerjaan'))>Pilih Jenis Pekerjaan</option>
                                    <option value="Belum/Tidak Bekerja" @selected(old('jenis_pekerjaan') == 'Belum/Tidak Bekerja')>Belum/Tidak Bekerja
                                    </option>
                                    <option value="Karyawan Swasta" @selected(old('jenis_pekerjaan') == 'Karyawan Swasta')>Karyawan Swasta</option>
                                    <option value="Mengurus Rumah Tangga" @selected(old('jenis_pekerjaan') == 'Mengurus Rumah Tangga')>Mengurus Rumah
                                        Tangga</option>
                                    <option value="Pegawai Negeri Sipil" @selected(old('jenis_pekerjaan') == 'Pegawai Negeri Sipil')>Pegawai Negeri Sipil
                                    </option>
                                    <option value="Pelajar/Mahasiswa" @selected(old('jenis_pekerjaan') == 'Pelajar/Mahasiswa')>Pelajar/Mahasiswa
                                    </option>
                                </x-input.select>
                                @error('jenis_pekerjaan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label> --}}

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis_pekerjaan">Jenis Pekerjaan
                                <select class="tw-input-enabled tw-placeholder" name="jenis_pekerjaan" id="jenis_pekerjaan">
                                    <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                                    <option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
                                    <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                    <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                </select>
                            </label> --}}

                            <x-input.label class="tw-relative" for="kewarganegaraan-list" label="Kewarganegaraan">
                                <x-input.select2 name="kewarganegaraan"
                                    default="{{ old('kewarganegaraan') ? old('kewarganegaraan') : 'Pilih Kewarganegaraan' }}"
                                    placeholder="Pilih Kewarganegaraan"></x-input.select2>

                                {{-- <x-input.select name="kewarganegaraan" id="kewarganegaraan">
                                    <option disabled @selected(!old('kewarganegaraan'))>Pilih Kewarganegaraan</option>
                                    <option value="WNI" @selected(old('kewarganegaraan', 'WNI') == 'WNI')>WNI</option>
                                    <option value="WNA" @selected(old('kewarganegaraan') == 'WNA')>WNA</option>
                                </x-input.select> --}}
                                @error('kewarganegaraan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kewarganegaraan">Kewarganegaraan
                                <select class="tw-input-enabled tw-placeholder" name=""
                                    id="kewarganegaraan">
                                    <option value="WNI">WNI</option>
                                    <option value="WNA">WNA</option>
                                </select>
                            </label> --}}

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label class="tw-relative" for="status_keluarga-list" label="Status Keluarga">
                                <x-input.select2 name="status_keluarga"
                                    default="{{ old('status_keluarga') ? old('status_keluarga') : 'Pilih Status' }}"
                                    placeholder="Pilih Status"></x-input.select2>
                                {{-- <x-input.select name="status_keluarga" id="status_keluarga">
                                    <option disabled @selected(!old('status_keluarga'))>Pilih Status</option>
                                    <option value="Kepala Keluarga" @selected(old('status_keluarga') == 'Kepala Keluarga')>Kepala Keluarga</option>
                                    <option value="Istri" @selected(old('status_keluarga') == 'Istri')>Istri</option>
                                    <option value="Anak" @selected(old('status_keluarga') == 'Anak')>Anak</option>
                                </x-input.select> --}}
                                @error('status_keluarga')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="status_keluarga">Status Keluarga
                                <select class="tw-input-enabled tw-placeholder" name="status_keluarga"
                                    id="status_keluarga">
                                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                </select>
                            </label> --}}

                            <x-input.label for="nama_ayah" label="Nama Ayah">
                                <x-input.input value="{{ old('nama_ayah') }}" placeholder="Masukkan Nama Ayah"
                                    type="text" id="nama_ayah" name="nama_ayah"></x-input.input>
                                @error('nama_ayah')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama_ayah">Nama Ayah
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nama Ayah"
                                    type="text" id="nama_ayah" name="nama_ayah">
                            </label> --}}

                            <x-input.label for="nama_ibu" label="Nama Ibu">
                                <x-input.input value="{{ old('nama_ibu') }}" placeholder="Masukkan Nama Ibu"
                                    type="text" id="nama_ibu" name="nama_ibu"></x-input.input>
                                @error('nama_ibu')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama_ibu">Nama Ibu
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nama Ibu"
                                    type="text" id="nama_ibu" name="nama_ibu">
                            </label> --}}

                            <x-input.label for="penghasilan" label="Penghasilan">
                                <x-input.leadingicon value="{{ old('penghasilan') }}" type="number" min="0"
                                    id="penghasilan" name="penghasilan" placeholder="Misal: 1000000" icon="rupiah"
                                    alt="Rp">
                                </x-input.leadingicon>
                                @error('penghasilan')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="penghasilan">
                                <div class="tw-relative tw-flex tw-w-full">
                                    <input type="number" min="0" id="penghasilan" name="penghasilan" placeholder="1000000"
                                        class="tw-input-enabled tw-pl-8 tw-pr-3" type="text">
                                    </input>
                                    <span
                                        class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-cursor-pointer">
                                        <img class="tw-w-7 tw-bg-cover"
                                            src="{{ asset('assets/icons/actionable/rupiah.svg') }}" alt="Rp">
                                    </span>
                                </div>
                            </label> --}}

                            <x-input.label for="no_paspor" label="Nomor Paspor">
                                <x-input.input value="{{ old('no_paspor') }}" placeholder="Masukkan Nomor Paspor"
                                    type="text" id="no_paspor" name="no_paspor"></x-input.input>
                                @error('no_paspor')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_paspor">Nomor Paspor
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nomor Paspor"
                                    type="text" id="no_paspor" name="no_paspor">
                            </label> --}}

                            <x-input.label for="no_kitas" label="Nomor Kitas">
                                <x-input.input value="{{ old('no_kitas') }}" placeholder="Masukkan Nomor Paspor"
                                    type="text" id="no_kitas" name="no_kitas"></x-input.input>
                                @error('no_kitas')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_kitas">Nomor Kitas
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nomor Paspor"
                                    type="text" id="no_kitas" name="no_kitas" value=''>
                            </label>  --}}
                        </div>
                    </div>

                    <div id="demografiMasuk" class="tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Demografi Masuk</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label class="tw-relative" for="jenis_demografi-list" label="Jenis">
                                <x-input.select2 name="jenis_demografi"
                                    default="{{ old('jenis_demografi') ? old('jenis_demografi') : 'Pilih Jenis Demografi' }}"
                                    placeholder="Pilih Jenis Demografi"></x-input.select2>
                                {{-- <x-input.select placeholder="Pilih Jenis Demografi" type="text" id="jenis_demografi"
                                    name="jenis_demografi">
                                    <option disabled @selected(!old('jenis_demografi'))>Pilih Jenis Demografi</option>
                                    <option value="Lahir" @selected(old('jenis_demografi') == 'Lahir')>Lahir</option>
                                    <option value="Migrasi Masuk" @selected(old('jenis_demografi') == 'Migrasi Masuk')>Migrasi Masuk</option>
                                    <option value="Migrasi Keluar" @selected(old('jenis_demografi') == 'Migrasi Keluar')>Migrasi Keluar</option>
                                    <option value="Meninggal" @selected(old('jenis_demografi') == 'Meninggal')>Meninggal</option>
                                </x-input.select> --}}
                                @error('jenis_demografi')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label for="tanggal_kejadian" label="Tanggal Kejadian">
                                <x-input.input value="{{ old('tanggal_kejadian') }}" placeholder="" type="date"
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

                            @if (session()->has('berkas_demografi'))
                                @php
                                    $img = session()->get('berkas_demografi');
                                @endphp
                                @include('components.form.textdetail', [
                                    'title' => '',
                                    'isImage' => true,
                                    'content' => 'data:image/' . $img->ext . ';base64, ' . $img->base64,
                                ])
                            @endif

                        </div>
                    </div>
                </div>


                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ route('keluarga-tambah') }}" class="tw-btn tw-btn-lg-ilead tw-btn-round tw-btn-outline"
                        type="button">
                        <x-icons.actionable.arrow-left class="" stroke="1.5"
                            color="n1000"></x-icons.actionable.arrow-left>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button type="submit"
                        class="tw-h-11 tw-flex tw-px-6 tw-bg-b500 tw-text-n100 tw-items-center tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
                        type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>

    @push('js')
        <script>
            function getWarga() {
                let arrayWarga = [];
                @foreach ($daftarWarga as $warga)
                    arrayWarga.push({
                        nama: '{{ $warga->nama }}',
                        nik: '{{ $warga->NIK }}'
                    })
                @endforeach
                let dataWarga = [];
                for (let i = 0; i < arrayWarga.length; i++) {
                    dataWarga[i] = arrayWarga[i].nik + ' - ' + arrayWarga[i].nama;
                    // dataWarga[i] = i;
                }
                return dataWarga;
            }

            function getJenisDemografi() {
                return ['Lahir', 'Migrasi Masuk'];
            }
        </script>
    @endpush
    @push('js')
        <script>
            function data_lama() {
                $('#formData').attr('action', '{{ route('pindahKK') }}');
                // $('#NIK').removeClass('tw-input-enabled');
                // $('#NIK').attr('type', 'hidden');
                // $('#NIK').prop('disabled', true);

                console.log("data_lama()");
                $("label[for='nik']").attr('for', 'nik-list');
                $("label[for='nik-list']").children().remove();
                $("label[for='nik-list']").append(`<x-input.select2 name="nik" searchable
                                    placeholder="Pilih NIK"></x-input.select2>`);

                $('#demografiMasuk').remove();

                $('#nama').val('');
                // $('#nama').removeClass('tw-input-enabled');
                // $('#nama').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama').attr('placeholder', 'Pilih NIK');
                $('#nama').prop('disabled', true);

                $('#tempat_lahir').val('');
                // $('#tempat_lahir').removeClass('tw-input-enabled');
                // $('#tempat_lahir').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#tempat_lahir').attr('placeholder', 'Pilih NIK');
                $('#tempat_lahir').prop('disabled', true);

                $('#tanggal_lahir').val('');
                // $('#tanggal_lahir').removeClass('tw-input-enabled');
                // $('#tanggal_lahir').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#tanggal_lahir').attr('placeholder', 'Pilih NIK');
                $('#tanggal_lahir').prop('disabled', true);

                $("label[for='jenis_kelamin-list']").attr('for', 'jenis_kelamin');
                $("label[for='jenis_kelamin']").children().remove();
                $("label[for='jenis_kelamin']").append(
                    `<x-input.input disabled value="Pilih NIK" type="text" name="jenis_kelamin" placeholder="Masukkan NIK"></x-input.input>`
                    );

                // $('#jenis_kelamin').val('');
                // $('#jenis_kelamin').removeClass('tw-input-enabled');
                // $('#jenis_kelamin').addClass('tw-input-disabled');
                // $('#jenis_kelamin').prop('disabled', true);

                $("label[for='pendidikan-list']").attr('for', 'pendidikan');
                $("label[for='pendidikan']").children().remove();
                $("label[for='pendidikan']").append(
                    `<x-input.input disabled value="Pilih NIK" type="text" name="pendidikan" placeholder="Masukkan NIK"></x-input.input>`
                    );

                // $('#pendidikan').val('');
                // $('#pendidikan').removeClass('tw-input-enabled');
                // $('#pendidikan').addClass('tw-input-disabled');
                // $('#pendidikan').prop('disabled', true);

                $("label[for='agama-list']").attr('for', 'agama');
                $("label[for='agama']").children().remove();
                $("label[for='agama']").append(
                    `<x-input.input disabled value="Pilih NIK" type="text" name="agama" placeholder="Masukkan NIK"></x-input.input>`
                    );
                // $('#agama').val('');
                // $('#agama').removeClass('tw-input-enabled');
                // $('#agama').addClass('tw-input-disabled');
                // $('#agama').prop('disabled', true);

                $("label[for='status_perkawinan-list']").attr('for', 'status_perkawinan');
                $("label[for='status_perkawinan']").children().remove();
                $("label[for='status_perkawinan']").append(
                    `<x-input.input disabled value="Pilih NIK" type="text" name="status_perkawinan" placeholder="Masukkan NIK"></x-input.input>`
                    );
                // $('#status_perkawinan').val('');
                // $('#status_perkawinan').removeClass('tw-input-enabled');
                // $('#status_perkawinan').addClass('tw-input-disabled');
                // $('#status_perkawinan').prop('disabled', true);

                $("label[for='jenis_pekerjaan-list']").attr('for', 'jenis_pekerjaan');
                $("label[for='jenis_pekerjaan']").children().remove();
                $("label[for='jenis_pekerjaan']").append(
                    `<x-input.input disabled value="Pilih NIK" type="text" name="jenis_pekerjaan" placeholder="Masukkan NIK"></x-input.input>`
                    );
                // $('#jenis_pekerjaan-list').addClass('tw-hidden');
                // $('#jenis_pekerjaan').val('');
                // $('#jenis_pekerjaan').attr('type', 'text');
                // $('#jenis_pekerjaan').removeClass('tw-input-enabled');
                // $('#jenis_pekerjaan').addClass('tw-input-disabled');
                // $('#jenis_pekerjaan').prop('disabled', true);

                $("label[for='kewarganegaraan-list']").attr('for', 'kewarganegaraan');
                $("label[for='kewarganegaraan']").children().remove();
                $("label[for='kewarganegaraan']").append(
                    `<x-input.input disabled value="Pilih NIK" type="text" name="kewarganegaraan" placeholder="Masukkan NIK"></x-input.input>`
                    );
                // $('#kewarganegaraan').val('');
                // $('#kewarganegaraan').removeClass('tw-input-enabled');
                // $('#kewarganegaraan').addClass('tw-input-disabled');
                // $('#kewarganegaraan').prop('disabled', true);

                // $('#status_ekluarga').val('');
                // $('#status_ekluarga').removeClass('tw-input-enabled');
                // $('#status_ekluarga').addClass('tw-input-disabled halo');

                $('#nama_ayah').val('');
                // $('#nama_ayah').removeClass('tw-input-enabled');
                // $('#nama_ayah').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama_ayah').attr('placeholder', 'Pilih NIK');
                $('#nama_ayah').prop('disabled', true);

                $('#nama_ibu').val('');
                // $('#nama_ibu').removeClass('tw-input-enabled');
                // $('#nama_ibu').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama_ibu').attr('placeholder', 'Pilih NIK');
                $('#nama_ibu').prop('disabled', true);

                $('#penghasilan').val('');
                // $('#penghasilan').removeClass('tw-input-enabled');
                // $('#penghasilan').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#penghasilan').attr('placeholder', 'Pilih NIK');
                $('#penghasilan').prop('disabled', true);

                $('#no_paspor').val('');
                // $('#no_paspor').removeClass('tw-input-enabled');
                // $('#no_paspor').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#no_paspor').attr('placeholder', 'Pilih NIK');
                $('#no_paspor').prop('disabled', true);

                $('#no_kitas').val('');
                // $('#no_kitas').removeClass('tw-input-enabled');
                // $('#no_kitas').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#no_kitas').attr('placeholder', 'Pilih NIK');
                $('#no_kitas').prop('disabled', true);



                // $('#nik-list').addClass('tw-input-enabled');
                // $('#nik-list').parent().removeClass('tw-hidden');
                // $('#nik-list').prop('disabled', false);


                // $.ajax({
                //     type: "GET",
                //     url: "/api/warga",
                //     success: function(response) {
                //         response.forEach(warga => {
                //             let optionHTML =
                //                 `<option value="${warga.nik}">${warga.nik} - ${warga.nama}</option>`;
                //             $('#nik-list').append(optionHTML);
                //         });
                //     }
                // });
            }

            function data_baru() {
                $('#formData').attr('action', '{{ route('tambah-warga-post') }}');
                $('#formData')[0].reset();
                // $('#NIK').addClass('tw-input-enabled');
                // $('#NIK').attr('type', 'text');
                // $('#NIK').prop('disabled', false);

                console.log("data_baru()");
                $("label[for='nik-list']").attr('for', 'nik');
                $("label[for='nik']").children().remove();
                $("label[for='nik']").append(`<x-input.input maxlength=16 value="{{ old('NIK') }}" type="text" name="NIK"
                                    placeholder="Masukkan NIK"></x-input.input>`);


                $('#formInput').append(
                    `<div id="demografiMasuk" class="tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Demografi Masuk</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <x-input.label class="tw-relative" for="jenis_demografi-list" label="Jenis">
                                <x-input.select2 name="jenis_demografi"
                                    default="{{ old('jenis_demografi') ? old('jenis_demografi') : 'Pilih Jenis Demografi' }}"
                                    placeholder="Pilih Jenis Demografi"></x-input.select2>
                                @error('jenis_demografi')
                                    <small class="form-text tw-text-red-600">{{ $message }}</small>
                                @enderror
                            </x-input.label>

                            <x-input.label for="tanggal_kejadian" label="Tanggal Kejadian">
                                <x-input.input value="{{ old('tanggal_kejadian') }}" placeholder="" type="date"
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

                            @if (session()->has('berkas_demografi'))
                                @php
                                    $img = session()->get('berkas_demografi');
                                @endphp
                                @include('components.form.textdetail', [
                                    'title' => '',
                                    'isImage' => true,
                                    'content' => 'data:image/' . $img->ext . ';base64, ' . $img->base64,
                                ])
                            @endif

                        </div>
                    </div>`
                );

                $('#nama').val('');
                // $('#nama').addClass('tw-input-enabled');
                // $('#nama').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama').attr('placeholder', 'Masukkan Nama');
                $('#nama').prop('disabled', false);

                $('#tempat_lahir').val('');
                // $('#tempat_lahir').addClass('tw-input-enabled');
                // $('#tempat_lahir').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#tempat_lahir').attr('placeholder', 'Masukkan Tempat Lahir');
                $('#tempat_lahir').prop('disabled', false);

                $('#tanggal_lahir').val('');
                // $('#tanggal_lahir').addClass('tw-input-enabled');
                // $('#tanggal_lahir').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#tanggal_lahir').attr('placeholder', 'Masukkan Tempat Lahir');
                $('#tanggal_lahir').prop('disabled', false);

                $("label[for='jenis_kelamin']").attr('for', 'jenis_kelamin-list');
                $("label[for='jenis_kelamin-list']").children().remove();
                $("label[for='jenis_kelamin-list']").append(`<x-input.select2 name="jenis_kelamin"
                                    default="{{ old('jenis_kelamin') == 'L' ? 'Laki-laki' : (old('jenis_kelamin') == 'P' ? 'Perempuan' : 'Pilih Jenis Kelamin') }}"
                                    placeholder="Pilih Jenis Kelamin"></x-input.select2>`);

                // $('#jenis_kelamin').addClass('tw-input-enabled');
                // $('#jenis_kelamin').removeClass('tw-input-disabled');
                // $('#jenis_kelamin').prop('disabled', false);

                $("label[for='pendidikan']").attr('for', 'pendidikan-list');
                $("label[for='pendidikan-list']").children().remove();
                $("label[for='pendidikan-list']").append(`<x-input.select2 searchable name="pendidikan"
                                    default="{{ old('pendidikan') ? old('pendidikan') : 'Pilih Pendidikan' }}"
                                    placeholder="Pilih Pendidikan"></x-input.select2>`);

                // $('#pendidikan').addClass('tw-input-enabled');
                // $('#pendidikan').removeClass('tw-input-disabled');
                // $('#pendidikan').prop('disabled', false);

                $("label[for='agama']").attr('for', 'agama-list');
                $("label[for='agama-list']").children().remove();
                $("label[for='agama-list']").append(`<x-input.select2 name="agama" default="{{ old('agama') ? old('agama') : 'Pilih Agama' }}"
                                    placeholder="Pilih Agama"></x-input.select2>`);

                // $('#agama').addClass('tw-input-enabled');
                // $('#agama').removeClass('tw-input-disabled');
                // $('#agama').prop('disabled', false);

                $("label[for='status_perkawinan']").attr('for', 'status_perkawinan-list');
                $("label[for='status_perkawinan-list']").children().remove();
                $("label[for='status_perkawinan-list']").append(`<x-input.select2 name="status_perkawinan"
                                    default="{{ old('status_perkawinan') ? old('status_perkawinan') : 'Pilih Status Perkawinan' }}"
                                    placeholder="Pilih Status Perkawinan"></x-input.select2>`);

                // $('#status_perkawinan').addClass('tw-input-enabled');
                // $('#status_perkawinan').removeClass('tw-input-disabled');
                // $('#status_perkawinan').prop('disabled', false);

                $("label[for='jenis_pekerjaan']").attr('for', 'jenis_pekerjaan-list');
                $("label[for='jenis_pekerjaan-list']").children().remove();
                $("label[for='jenis_pekerjaan-list']").append(`<x-input.select2 name="jenis_pekerjaan" searchable
                                    default="{{ old('jenis_pekerjaan') ? old('jenis_pekerjaan') : 'Pilih Jenis Pekerjaan' }}"
                                    placeholder="Pilih Jenis Pekerjaan"></x-input.select2>`);

                // $('#jenis_pekerjaan-list').removeClass('tw-hidden');
                // $('#jenis_pekerjaan').attr('type', 'hidden');
                // $('#jenis_pekerjaan').addClass('tw-input-enabled');
                // $('#jenis_pekerjaan').removeClass('tw-input-disabled');
                // $('#jenis_pekerjaan').prop('disabled', false);

                $("label[for='kewarganegaraan']").attr('for', 'kewarganegaraan-list');
                $("label[for='kewarganegaraan-list']").children().remove();
                $("label[for='kewarganegaraan-list']").append(`<x-input.select2 name="kewarganegaraan"
                                    default="{{ old('kewarganegaraan') ? old('kewarganegaraan') : 'Pilih Kewarganegaraan' }}"
                                    placeholder="Pilih Kewarganegaraan"></x-input.select2>`);

                // $('#kewarganegaraan').addClass('tw-input-enabled');
                // $('#kewarganegaraan').removeClass('tw-input-disabled');
                // $('#kewarganegaraan').prop('disabled', false);

                // $('#status_keluarga').addClass('tw-input-enabled');
                // $('#status_keluarga').removeClass('tw-input-disabled');

                $('#nama_ayah').val();
                // $('#nama_ayah').addClass('tw-input-enabled');
                // $('#nama_ayah').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama_ayah').attr('placeholder', 'Masukkan Nama Ayah');
                $('#nama_ayah').prop('disabled', false);

                $('#nama_ibu').val();
                // $('#nama_ibu').addClass('tw-input-enabled');
                // $('#nama_ibu').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama_ibu').attr('placeholder', 'Masukkan Nama Ibu');
                $('#nama_ibu').prop('disabled', false);

                $('#penghasilan').val();
                // $('#penghasilan').addClass('tw-input-enabled');
                // $('#penghasilan').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#penghasilan').attr('placeholder', 'Misal: 1000000');
                $('#penghasilan').prop('disabled', false);

                $('#penghasilan').val();
                // $('#no_paspor').addClass('tw-input-enabled');
                // $('#no_paspor').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#no_paspor').attr('placeholder', 'Masukkan Nomor Paspor');
                $('#no_paspor').prop('disabled', false);

                $('#no_kitas').val();
                // $('#no_kitas').addClass('tw-input-enabled');
                // $('#no_kitas').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#no_kitas').attr('placeholder', 'Masukkan Nomor Kitas');
                $('#no_kitas').prop('disabled', false);



                // $('#nik-list').removeClass('tw-input-enabled');
                // $('#nik-list').parent().addClass('tw-hidden');
                // $('#nik-list').prop('disabled', true);
            }

            function demografi_birth_date() {
                let birthDate = $('#tanggal_lahir').val();
                $('#tanggal_kejadian').val(birthDate);
                $('#tanggal_kejadian').attr('readonly', true);
            }

            function non_demografi_birth_date() {
                $('#tanggal_kejadian').attr('disabled', false);
                $('#tanggal_kejadian').val('');
            }
            $(document).ready(function() {
                if (`{{ session()->exists('data_lama') ? session()->get('data_lama') : false }}`) {
                    data_lama();
                    $('#jenis_data').val('Data Lama');
                    $('#jenis_data-list').children().first().text('Data Lama');
                }

                $(document).on("change", "#tanggal_lahir", function() {
                    if ($("#jenis_demografi").val() == 'Lahir') {
                        $('#tanggal_kejadian').val($('#tanggal_lahir').val());
                    }
                });

                $(document).on("click", ".dropdownItem", function() {
                    if ($(this).text() == 'Data Baru') {
                        data_baru();
                    }
                    if ($(this).text() == 'Data Lama') {
                        data_lama();
                    }
                    if ($(this).text() == 'Lahir') {
                        demografi_birth_date();
                    }
                    if ($(this).text() == 'Migrasi Masuk' || $(this).text() == 'Migrasi Keluar' || $(this)
                        .text() == 'Meninggal') {
                        non_demografi_birth_date();
                    }

                    console.log('EOI');
                    if ($('#jenis_data').val() == 'Data Lama' && $(this).parents().parents().parents().attr(
                            'for') == 'nik-list') {
                        var data = $(this).text().split(' - ');
                        var nik = data[0];
                        $('input#nik').val(nik);
                        console.log($('input#nik').val());
                        console.log($('input#nik').html());
                        $.ajax({
                            type: "GET",
                            url: "/api/warga/" + nik,
                            success: function(response) {
                                console.log(response);
                                $.each(response, function(key, val) {
                                    // console.log(key+val);
                                    if (val === null) {
                                        console.log(val);
                                        if (key == 'nik') {

                                        }
                                        $('#' + key).attr('placeholder', '-');
                                    }
                                    console.log(key.toLowerCase()+"=>"+val);
                                    $('#' + key.toLowerCase()).val(val);
                                });
                            }
                        });
                    }
                });

                $('#jenis_data-list').siblings().last().children().click(function() {
                    // $('#jenis_data').change(function() {
                    // $('#jenis_data').change(function() {
                    console.log();
                    // if ($('#jenis_data').attr('value') == 'Data Lama') {
                    //     console.log($('#jenis_data').attr('value') + ' == LAMA');
                    //     data_lama();
                    // }
                    // if ($('#jenis_data').attr('value') == 'Data Baru') {
                    //     console.log($('#jenis_data').attr('value') + ' == BARU');
                    //     data_baru();
                    // }
                });


                $('#jenis_data').change(function(e) {});

                $('input #jenis_data').on('change', function() {

                });
            });

            // $('#nik').on('change', function() {
            //     if ($('#jenis_data').val() == 'Data Lama') {
            //         console.log('AJAX' + this.value);
            //     }
            //     $.ajax({
            //         type: "GET",
            //         url: "/api/warga/" + this.value,
            //         success: function(response) {
            //             console.log(response);
            //             $.each(response, function(key, val) {
            //                 // console.log(key+val);
            //                 if (val === null) {
            //                     console.log(val);
            //                     $('#' + key).attr('placeholder', '-');
            //                 }
            //                 $('#' + key).val(val);
            //             });
            //         }
            //     });
            // });
        </script>
    @endpush
@endsection
