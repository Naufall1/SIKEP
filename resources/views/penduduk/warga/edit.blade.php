@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Warga / Detail Warga /
            <span class="tw-font-bold tw-text-b500">Perbarui Data</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Perbarui Data Warga</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('tambah-warga-post') }}" method="POST" id="formData">
                {{ csrf_field() }}

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Identitas Warga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3" id="identitasWarga">

                            <x-input.label for="nik" label="NIK">
                                <x-input.input value="HERE" type="text" id="nik" name="nik" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nik">NIK
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text" id="nik"
                                    name="nik" disabled>
                            </label> --}}

                            <x-input.label for="nama" label="Nama">
                                <x-input.input value="HERE" type="text" id="nama" name="nama" disabled></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama">Nama
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text" id="nama"
                                    name="nama" disabled>
                            </label> --}}

                            <x-input.label for="tempat_lahir" label="Tempat Lahir">
                                <x-input.input value="HERE" type="text" id="tempat_lahir" name="tempat_lahir" ></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tempat_lahir">Tempat Lahir
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="tempat_lahir" name="tempat_lahir" disabled>
                            </label> --}}

                            <x-input.label for="tanggal_lahir" label="Tanggal Lahir">
                                <x-input.input value="HERE" type="date" id="tanggal_lahir" name="tanggal_lahir" ></x-input.input>
                            </x-input.label>
                            
                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tanggal_lahir">Tanggal Lahir
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="date"
                                    id="tanggal_lahir" name="tanggal_lahir" disabled>
                            </label> --}}

                            <x-input.label for="jenis_kelamin" label="Jenis Kelamin">
                                <x-input.input value="HERE" type="text" id="jenis_kelamin" name="jenis_kelamin"></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis_kelamin">Jenis Kelamin
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="date"
                                    id="jenis_kelamin" name="jenis_kelamin" disabled>
                            </label> --}}

                            <x-input.label for="pendidikan" label="Pendidikan">
                                <x-input.select name="pendidikan" id="pendidikan">
                                    <option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
                                    <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                                    <option value="DIPLOMA I/II">DIPLOMA I/II</option>
                                    <option value="Diploma IV/Strata 1">Diploma IV/Strata 1</option>
                                </x-input.select>
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
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Konghuchu">Konghuchu</option>
                                </x-input.select>
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
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </x-input.select>
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
                                    <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                                    <option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
                                    <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                    <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                </x-input.select>
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
                                <x-input.input value="HERE" type="text" id="kewarganegaraan" name="kewarganegaraan" ></x-input.input>
                            </x-input.label>
                            

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kewarganegaraan">Kewarganegaraan
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="kewarganegaraan" name="kewarganegaraan" disabled>
                            </label> --}}

                            <x-input.label for="status_warga" label="Status Warga">
                                <x-input.select name="status_warga" id="status_warga">
                                    <option value="Aktif" selected>Aktif</option>
                                    <option value="Migrasi">Migrasi</option>
                                    <option value="Meninggal">Meninggal</option>
                                </x-input.select>
                            </x-input.label>

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
                                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
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
                                <x-input.input value="HERE" type="text" id="nama_ayah" name="nama_ayah" ></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama_ayah">Nama Ayah
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="nama_ayah" name="nama_ayah" disabled>
                            </label> --}}

                            <x-input.label for="nama_ibu" label="Nama Ibu">
                                <x-input.input value="HERE" type="text" id="nama_ibu" name="nama_ibu"></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama_ibu">Nama Ibu
                                <input class="tw-input-disabled tw-placeholder" value="HERE" type="text"
                                    id="nama_ibu" name="nama_ibu" disabled>
                            </label> --}}

                            <x-input.label for="penghasilan" label="Penghasilan">
                                <x-input.leadingicon type="number" min="0" id="penghasilan" name="penghasilan" placeholder="HERE" icon="rupiah" alt="Rp">
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
                                <x-input.input value="HERE" type="text" id="no_paspor" name="no_paspor"></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_paspor">Nomor Paspor
                                <input class="tw-input-enabled tw-placeholder" placeholder="HERE" value="HERE"
                                    type="text" id="no_paspor" name="no_paspor">
                            </label> --}}

                            <x-input.label for="no_kitas" label="Nomor Kitas">
                                <x-input.input value="HERE" type="text" id="no_kitas" name="no_kitas"></x-input.input>
                            </x-input.label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_kitas">Nomor Kitas
                                <input class="tw-input-enabled tw-placeholder" placeholder="HERE" value="HERE"
                                    type="text" id="no_kitas" name="no_kitas" value=''>
                            </label> --}}
                        </div>
                    </div>

                    <div id="demografiMasuk" class="tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Demografi Masuk</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">
                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="status_warga">Jenis <select
                                    class="tw-input-disabled tw-placeholder tw-appearance-none" name="status_warga" id="status_warga"
                                    disabled>
                                    <option value="Aktif" selected>Aktif</option>
                                    <option value="Migrasi">Migrasi</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select>
                            </label>
                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="berkas_demografi_masuk">Berkas
                                Pendukung <div class="tw-relative tw-cursor-pointer tw-input-enabled"> <input
                                        id="berkas_demografi_masuk" type="file"
                                        class=" tw-flex tw-py-[9px] file:tw-absolute file:tw-top-1/2 file:-tw-translate-y-1/2 file:tw-right-0 file:tw-h-full file:tw-border-y-0 file: file:tw-border-r-0 file:tw-border-l-[1.5px] file:tw-rounded-r-md file:tw-px-2 file:hover:tw-bg-n200 file:hover:tw-border-n600 file:active:tw-border-n600 file:tw-justify-center tw-cursor-pointer file:tw-cursor-pointer  file:tw-border-n400 file:tw-bg-n100 file:tw-m-0 ">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ route('keluarga-tambah') }}"
                        class="tw-relative tw-min-w-16 tw-flex tw-items-center tw-px-5 tw-h-11 md:tw-pl-12 md:tw-pr-6 tw-bg-n100 tw-border-2 tw-border-n500 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n300 active:tw-border-n1000"
                        type="button">
                        <span
                            class="md:tw-absolute md:tw-top-1/2 md:-tw-translate-y-1/2 md:tw-left-2 tw-flex tw-items-center md:tw-pl-2 tw-cursor-pointer">
                            <img src="{{ asset('assets/icons/actionable/arrow-left.svg') }}" alt="back">
                        </span>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button href="{{ route('keluarga-tambah') }}" type="submit"
                        class="tw-h-11 tw-flex tw-px-6 tw-bg-b500 tw-text-n100 tw-items-center tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
                        type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#status_warga').change(function() {
                const selectedStatusWarga = $(this).val();
                const fileStatusWarga = '<label class="tw-label tw-flex tw-flex-col tw-gap-2" for="berkas_demografi_keluar">Berkas Pendukung <div class="tw-relative tw-cursor-pointer tw-input-enabled"> <input id="berkas_demografi_keluar" type="file" class=" tw-flex tw-py-[9px] file:tw-absolute file:tw-top-1/2 file:-tw-translate-y-1/2 file:tw-right-0 file:tw-h-full file:tw-border-y-0 file: file:tw-border-r-0 file:tw-border-l-[1.5px] file:tw-rounded-r-md file:tw-px-2 file:hover:tw-bg-n200 file:hover:tw-border-n600 file:active:tw-border-n600 file:tw-justify-center tw-cursor-pointer file:tw-cursor-pointer  file:tw-border-n400 file:tw-bg-n100 file:tw-m-0 " required> </div></label>'
                if (selectedStatusWarga !== 'Aktif' && !$('#berkas_demografi_keluar').length) {
                    $('#identitasWarga').append(fileStatusWarga);
                } else if(selectedStatusWarga === 'Aktif') {
                    $('#berkas_demografi_keluar').parent().parent().remove();
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
