@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Penduduk / Tambah Keluarga /
            <span class="tw-font-bold tw-text-b500">Tambah Anggota</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Tambah Data</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('tambah-warga-post') }}" method="POST" id="formData">
                {{ csrf_field() }}

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] ">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Identitas Warga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <input type="hidden" name="no_kk" id="no_kk" value="{{ $no_kk }}">

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis-data">Jenis Data
                                <select class="tw-input-enabled" name="jenis-data" id="jenis-data">
                                    <option value="data-baru">Warga Baru</option>
                                    <option value="data-lama">Warga Lama</option>
                                </select>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nik">NIK
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan NIK" type="text"
                                    id="nik" name="nik">
                                <select class="tw-hidden tw-placeholder" name="nik" id="nik-list" disabled>
                                    <option value="data-baru" disabled selected>Pilih Warga</option>
                                </select>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama">Nama
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nama" type="text"
                                    id="nama" name="nama">
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tempat_lahir">Tempat Lahir
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Tempat Lahir"
                                    type="text" id="tempat_lahir" name="tempat_lahir">
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tanggal_lahir">Tanggal Lahir
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Tempat Lahir"
                                    type="date" id="tanggal_lahir" name="tanggal_lahir">
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis_kelamin">Jenis Kelamin
                                <select class="tw-input-enabled tw-placeholder" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="pendidikan">Pendidikan
                                <select class="tw-input-enabled tw-placeholder" name="pendidikan" id="pendidikan">
                                    <option value="Tamat SD/Sederajat">Tamat SD/Sederajat</option>
                                    <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                                    <option value="DIPLOMA I/II">DIPLOMA I/II</option>
                                    <option value="Diploma IV/Strata 1">Diploma IV/Strata 1</option>
                                </select>
                            </label>

                            <label class="tw-label tw-opacity-100 tw-flex tw-flex-col tw-gap-2" for="agama">Agama
                                <select class="tw-input-enabled tw-placeholder" name="agama" id="agama">
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Konghuchu">Konghuchu</option>
                                </select>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="status_perkawinan">Status Perkawinan
                                <select class="tw-input-enabled tw-placeholder" name="status_perkawinan"
                                    id="status_perkawinan">
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis_pekerjaan">Jenis Pekerjaan
                                <select class="tw-input-enabled tw-placeholder" name="jenis_pekerjaan" id="jenis_pekerjaan">
                                    <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                                    <option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
                                    <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                    <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                </select>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kewarganegaraan">Kewarganegaraan
                                <select class="tw-input-enabled tw-placeholder" name="kewarganegaraan"
                                    id="kewarganegaraan">
                                    <option value="WNI">WNI</option>
                                    <option value="WNA">WNA</option>
                                </select>
                            </label>

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="status_keluarga">Status Keluarga
                                <select class="tw-input-enabled tw-placeholder" name="status_keluarga"
                                    id="status_keluarga">
                                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                </select>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama_ayah">Nama Ayah
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nama Ayah"
                                    type="text" id="nama_ayah" name="nama_ayah">
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="nama_ibu">Nama Ibu
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nama Ibu"
                                    type="text" id="nama_ibu" name="nama_ibu">
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="penghasilan">Penghasilan
                                <div class="tw-relative tw-flex tw-w-full">
                                    <input type="text" id="penghasilan" name="penghasilan" placeholder="1000000"
                                        class="tw-input-enabled tw-pl-8 tw-pr-3" type="text">
                                    </input>
                                    <span
                                        class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-cursor-pointer">
                                        <img class="tw-w-7 tw-bg-cover"
                                            src="{{ asset('assets/icons/actionable/rupiah.svg') }}" alt="Rp">
                                    </span>
                                </div>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_paspor">Nomor Paspor
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nomor Paspor"
                                    type="text" id="no_paspor" name="no_paspor">
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_kitas">Nomor Kitas
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Nomor Paspor"
                                    type="text" id="no_kitas" name="no_kitas" value=''>
                            </label>
                        </div>
                    </div>

                    <div id="demografiMasuk" class="tw-flex tw-flex-col tw-gap-2  tw-pt-6">
                        <h2 class="">Demografi Masuk</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3"> <label class="tw-label tw-flex tw-flex-col tw-gap-2"
                                for="status_warga">Jenis <select class="tw-input-disabled tw-placeholder"
                                    name="status_warga" id="status_warga" disabled>
                                    <option value="Aktif" selected>Aktif</option>
                                    <option value="Migrasi">Migrasi</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select> </label> <label class="tw-label tw-flex tw-flex-col tw-gap-2"
                                for="berkas_demografi_masuk">Berkas Pendukung <div
                                    class="tw-relative tw-cursor-pointer tw-input-enabled"> <input
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
        $('#jenis-data').on('change', function() {
            if (this.value == 'data-lama') {
                $('#formData').attr('action', '{{ route('pindahKK') }}');
                $('#nik').removeClass('tw-input-enabled');
                $('#nik').attr('type', 'hidden');
                $('#nik').prop('disabled', true);

                console.log();

                $('#demografiMasuk').remove();

                $('#nama').val('');
                $('#nama').removeClass('tw-input-enabled');
                $('#nama').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama').attr('placeholder', 'Pilih NIK');
                $('#nama').prop('disabled', true);

                $('#tempat_lahir').val('');
                $('#tempat_lahir').removeClass('tw-input-enabled');
                $('#tempat_lahir').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#tempat_lahir').attr('placeholder', 'Pilih NIK');
                $('#tempat_lahir').prop('disabled', true);

                $('#tanggal_lahir').val('');
                $('#tanggal_lahir').removeClass('tw-input-enabled');
                $('#tanggal_lahir').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#tanggal_lahir').attr('placeholder', 'Pilih NIK');
                $('#tanggal_lahir').prop('disabled', true);

                $('#jenis_kelamin').val('');
                $('#jenis_kelamin').removeClass('tw-input-enabled');
                $('#jenis_kelamin').addClass('tw-input-disabled');
                $('#jenis_kelamin').prop('disabled', true);

                $('#pendidikan').val('');
                $('#pendidikan').removeClass('tw-input-enabled');
                $('#pendidikan').addClass('tw-input-disabled');
                $('#pendidikan').prop('disabled', true);

                $('#agama').val('');
                $('#agama').removeClass('tw-input-enabled');
                $('#agama').addClass('tw-input-disabled');
                $('#agama').prop('disabled', true);

                $('#status_perkawinan').val('');
                $('#status_perkawinan').removeClass('tw-input-enabled');
                $('#status_perkawinan').addClass('tw-input-disabled');
                $('#status_perkawinan').prop('disabled', true);

                $('#jenis_pekerjaan').val('');
                $('#jenis_pekerjaan').removeClass('tw-input-enabled');
                $('#jenis_pekerjaan').addClass('tw-input-disabled');
                $('#jenis_pekerjaan').prop('disabled', true);

                $('#kewarganegaraan').val('');
                $('#kewarganegaraan').removeClass('tw-input-enabled');
                $('#kewarganegaraan').addClass('tw-input-disabled');
                $('#kewarganegaraan').prop('disabled', true);

                $('#status_ekluarga').val('');
                $('#status_ekluarga').removeClass('tw-input-enabled');
                $('#status_ekluarga').addClass('tw-input-disabled halo');

                $('#nama_ayah').val('');
                $('#nama_ayah').removeClass('tw-input-enabled');
                $('#nama_ayah').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama_ayah').attr('placeholder', 'Pilih NIK');
                $('#nama_ayah').prop('disabled', true);

                $('#nama_ibu').val('');
                $('#nama_ibu').removeClass('tw-input-enabled');
                $('#nama_ibu').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama_ibu').attr('placeholder', 'Pilih NIK');
                $('#nama_ibu').prop('disabled', true);

                $('#penghasilan').val('');
                $('#penghasilan').removeClass('tw-input-enabled');
                $('#penghasilan').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#penghasilan').attr('placeholder', 'Pilih NIK');
                $('#penghasilan').prop('disabled', true);

                $('#no_paspor').val('');
                $('#no_paspor').removeClass('tw-input-enabled');
                $('#no_paspor').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#no_paspor').attr('placeholder', 'Pilih NIK');
                $('#no_paspor').prop('disabled', true);

                $('#no_kitas').val('');
                $('#no_kitas').removeClass('tw-input-enabled');
                $('#no_kitas').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#no_kitas').attr('placeholder', 'Pilih NIK');
                $('#no_kitas').prop('disabled', true);



                $('#nik-list').addClass('tw-input-enabled');
                $('#nik-list').removeClass('tw-hidden');
                $('#nik-list').prop('disabled', false);
                $.ajax({
                    type: "GET",
                    url: "/api/warga",
                    success: function(response) {
                        response.forEach(warga => {
                            let optionHTML =
                                `<option value="${warga.nik}">${warga.nik} - ${warga.nama}</option>`;
                            $('#nik-list').append(optionHTML);
                        });
                    }
                });
            }
            if (this.value == 'data-baru') {
                $('#formData').attr('action', '{{ route('tambah-warga-post') }}');
                $('#formData')[0].reset();
                $('#nik').addClass('tw-input-enabled');
                $('#nik').attr('type', 'text');
                $('#nik').prop('disabled', false);

                $('#formInput').append(
                    '<div id="demografiMasuk" class="tw-flex tw-flex-col tw-gap-2  tw-pt-6"> <h2 class="">Demografi Masuk</h2> <div class="tw-flex tw-flex-col tw-gap-3"> <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="status_warga">Jenis <select class="tw-input-disabled tw-placeholder" name="status_warga" id="status_warga" disabled> <option value="Aktif" selected>Aktif</option> <option value="Migrasi">Migrasi</option> <option value="Meninggal">Meninggal</option> </select> </label> <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="berkas_demografi_masuk">Berkas Pendukung <div class="tw-relative tw-cursor-pointer tw-input-enabled"> <input id="berkas_demografi_masuk" type="file" class=" tw-flex tw-py-[9px] file:tw-absolute file:tw-top-1/2 file:-tw-translate-y-1/2 file:tw-right-0 file:tw-h-full file:tw-border-y-0 file: file:tw-border-r-0 file:tw-border-l-[1.5px] file:tw-rounded-r-md file:tw-px-2 file:hover:tw-bg-n200 file:hover:tw-border-n600 file:active:tw-border-n600 file:tw-justify-center tw-cursor-pointer file:tw-cursor-pointer  file:tw-border-n400 file:tw-bg-n100 file:tw-m-0 "> </div> </label> </div> </div>'
                );

                $('#nama').addClass('tw-input-enabled');
                $('#nama').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama').attr('placeholder', 'Masukkan Nama');
                $('#nama').prop('disabled', false);

                $('#tempat_lahir').addClass('tw-input-enabled');
                $('#tempat_lahir').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#tempat_lahir').attr('placeholder', 'Masukkan Tempat Lahir');
                $('#tempat_lahir').prop('disabled', false);

                $('#tanggal_lahir').addClass('tw-input-enabled');
                $('#tanggal_lahir').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#tanggal_lahir').attr('placeholder', 'Masukkan Tempat Lahir');
                $('#tanggal_lahir').prop('disabled', false);

                $('#jenis_kelamin').addClass('tw-input-enabled');
                $('#jenis_kelamin').removeClass('tw-input-disabled');
                $('#jenis_kelamin').prop('disabled', false);

                $('#pendidikan').addClass('tw-input-enabled');
                $('#pendidikan').removeClass('tw-input-disabled');
                $('#pendidikan').prop('disabled', false);

                $('#agama').addClass('tw-input-enabled');
                $('#agama').removeClass('tw-input-disabled');
                $('#agama').prop('disabled', false);

                $('#status_perkawinan').addClass('tw-input-enabled');
                $('#status_perkawinan').removeClass('tw-input-disabled');
                $('#status_perkawinan').prop('disabled', false);

                $('#jenis_pekerjaan').addClass('tw-input-enabled');
                $('#jenis_pekerjaan').removeClass('tw-input-disabled');
                $('#jenis_pekerjaan').prop('disabled', false);

                $('#kewarganegaraan').addClass('tw-input-enabled');
                $('#kewarganegaraan').removeClass('tw-input-disabled');
                $('#kewarganegaraan').prop('disabled', false);

                $('#status_keluarga').addClass('tw-input-enabled');
                $('#status_keluarga').removeClass('tw-input-disabled');

                $('#nama_ayah').addClass('tw-input-enabled');
                $('#nama_ayah').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama_ayah').attr('placeholder', 'Masukkan Nama Ayah');
                $('#nama_ayah').prop('disabled', false);

                $('#nama_ibu').addClass('tw-input-enabled');
                $('#nama_ibu').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#nama_ibu').attr('placeholder', 'Masukkan Nama Ibu');
                $('#nama_ibu').prop('disabled', false);

                $('#penghasilan').addClass('tw-input-enabled');
                $('#penghasilan').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#penghasilan').attr('placeholder', '1000000');
                $('#penghasilan').prop('disabled', false);

                $('#no_paspor').addClass('tw-input-enabled');
                $('#no_paspor').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#no_paspor').attr('placeholder', 'Masukkan Nomor Paspor');
                $('#no_paspor').prop('disabled', false);

                $('#no_kitas').addClass('tw-input-enabled');
                $('#no_kitas').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#no_kitas').attr('placeholder', 'Masukkan Nomor Kitas');
                $('#no_kitas').prop('disabled', false);



                $('#nik-list').removeClass('tw-input-enabled');
                $('#nik-list').addClass('tw-hidden');
                $('#nik-list').prop('disabled', true);
            }
        });
        $('#nik-list').on('change', function() {
            console.log(this.value);
            $.ajax({
                type: "GET",
                url: "/api/warga/" + this.value,
                success: function(response) {
                    console.log(response);
                    $.each(response, function(key, val) {
                        // console.log(key+val);
                        if (val === null) {
                            console.log(val);
                            $('#' + key).attr('placeholder', '-');
                        }
                        $('#' + key).val(val);
                    });
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
        <a href="{{url()->previous()}}">Simpan</a>
    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
</body>
</html> --}}
