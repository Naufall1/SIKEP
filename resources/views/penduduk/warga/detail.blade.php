@extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Warga /
            <span class="tw-font-bold tw-text-b500">Detail Warga</span>
        </p>

        <div class="md:tw-w-full">

            <div
                class="tw-flex {{ Auth::user()->hasLevel['level_kode'] == 'RT' ? 'tw-justify-between' : '' }}  tw-w-full tw-items-center tw-pb-2 md:tw-items-start">

                <h1 class="tw-h1 tw-w-3/4 md:tw-w-fit">Detail Data Warga</h1>
                @if (Auth::user()->hasLevel['level_kode'] == 'RT')
                    <a href=""
                        class="tw-flex tw-items-center tw-relative tw-h-10 tw-pl-10 tw-pr-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-sm tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
                        type="button">
                        <span
                            class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-pl-2 tw-cursor-pointer">
                            <img class="tw-h-5 tw-bg-cover" src="{{ asset('assets/icons/actionable/edit.svg') }}"
                                alt="edit">
                        </span>
                        <span class="">
                            Perbarui
                        </span>
                    </a>
                @endif
            </div>

            <div class="tw-flex tw-flex-col tw-gap-7">

                <div class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Detail Warga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'NIK',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nama',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Tempat Lahir',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Tanggal Lahir',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Jenis Kelamin',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Pendidikan',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Agama',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status Perkawinan',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Pekerjaan',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Kewarganegaraan',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Status Warga',
                                'content' => 'Aktif',
                                'isLabel' => true,
                            ]) {{-- kalau label kasih value var $isLabel with true --}}

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                        <h2 class="">Data Tambahan</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            @include('components.form.textdetail', [
                                'title' => 'Status Keluarga',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nama Ayah',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nama Ibu',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Penghasilan',
                                'content' => 'Rp' . 'adshf',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nomor Paspor',
                                'content' => 'akfdj',
                            ])
                            @include('components.form.textdetail', [
                                'title' => 'Nomor Kitas',
                                'content' => 'akfdj',
                            ])

                        </div>
                    </div>

                    <div class="tw-flex tw-flex-col md:tw-flex-row md:tw-justify-between">

                        <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                            <h2 class="">Demografi Masuk</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">

                                @include('components.form.textdetail', [
                                    'title' => 'Jenis',
                                    'content' => 'Migrasi',
                                ])
                                @include('components.form.textdetail', [
                                    'title' => 'Tanggal',
                                    'content' => '01/12/2010',
                                ])
                                @include('components.form.textdetail', [
                                    'isImage' => true,
                                    'title' => 'Berkas Pendukung',
                                    'content' => 'akfdj',
                                ]) {{-- kalau label kasih value var $isLabel with true --}}

                            </div>
                        </div>

                        {{-- if user status user migrasi/meninggal --}}
                        {{-- @if ()
                            
                        <div class="tw-flex tw-flex-col tw-gap-2 tw-pt-6">
                            <h2 class="">Demografi Keluar</h2>
                            <div class="tw-flex tw-flex-col tw-gap-3">

                                @include('components.form.textdetail', [
                                    'title' => 'Jenis',
                                    'content' => 'Meninggal',
                                ])
                                @include('components.form.textdetail', [
                                    'title' => 'Tanggal',
                                    'content' => '01/12/2020',
                                ])
                                @include('components.form.textdetail', [
                                    'isImage' => true,
                                    'title' => 'Berkas Pendukung',
                                    'content' => 'akfdj',
                                ]) 
                                kalau label kasih value var $isLabel with true

                            </div>
                        </div>
                        
                        @endif --}}
                    </div>

                    <div class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-overflow-x-scroll">
                        <h2 class="">Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">

                            <table class="tw-w-[702px] md:tw-w-full">
                                {{-- <thead class="tw-rounded-lg"> --}}
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                    <th>No</th>
                                    <th>No KK</th>
                                    <th>Kepala Keluarga</th>
                                    <th>RT</th>
                                    <th class="tw-w-[108px]"></th>
                                </tr>
                                </thead>
                                <tbody>
                                        <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td
                                                class="tw-w-[140px] tw-h-16 tw-flex tw-items-center tw-justify-center tw-gap-2">
                                                <a href=""
                                                    class="tw-h-10 tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>


                <div class="tw-flex">
                    <a href="{{ url()->previous() }}"
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
                </div>
            </div>

        </div>
    </div>

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
