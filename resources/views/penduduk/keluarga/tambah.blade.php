{{-- @extends('layout.layout', ['isForm' => true])

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Penduduk /
            <span class="tw-font-bold tw-text-b500">Tambah Keluarga</span>
        </p>

        <div class="md:tw-w-80">

            <h1 class="tw-h1 tw-mb-3">Tambah Data</h1>

            <form action="{{ route('keluarga-tambah') }}" method="POST" enctype="multipart/form-data" id="formdata">
                @csrf

                <div class="tw-flex tw-flex-col tw-gap-2">
                    <h2 class="">Kriteria Keluarga</h2>
                    <div class="tw-flex tw-flex-col tw-gap-3">

                        <label for="jenis_data" class="tw-label tw-flex tw-flex-col tw-gap-2">Jenis Data
                            <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                <select id="jenis_data" class="tw-input-enabled">
                                    <option class="tw-box-border tw-border-[1.5px] tw-border-n400 tw-w-full tw-h-11 tw-px-3 tw-bg-n100" selected value="kk_baru">KK Baru</option>
                                    <option value="kk_lama">KK Lama</option>
                                </select>
                                <span for="jenis_data"
                                    class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2">
                                    <img id="eyeIcon" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                        alt="down">
                                </span>
                            </div>
                        </label>

                        <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_kk">Luas Bangunan (m2)
                            <input clas type="text" id="no_kk" name="no_kk"
                                value="{{ $dataKeluarga->luas_bangunan }}" class="tw-input-enabled">
                        </label>

                        
                    </div>
                </div>

                <div class="tw-divider-hr"></div>




                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <button
                        class="tw-relative tw-min-w-16 tw-px-5 tw-h-11 md:tw-pl-12 md:tw-pr-6 tw-bg-n100 tw-border-2 tw-border-n500 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n300 active:tw-border-n1000"
                        type="button">
                        <span
                            class="md:tw-absolute md:tw-top-1/2 md:-tw-translate-y-1/2 md:tw-left-2 tw-flex tw-items-center md:tw-pl-2 tw-cursor-pointer">
                            <img src="{{ asset('assets/icons/actionable/arrow-left.svg') }}" alt="back">
                        </span>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </button>
                    <button
                        class="tw-h-11 tw-px-6 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
                        type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Form Penambahan Data</title>
</head>
<body>
    <h2>Form Penambahan Data</h2>
    <form action="{{ route('keluarga-tambah') }}" method="POST" enctype="multipart/form-data" id="formdata">
        @csrf

        <label for="no_kk">Nomor KK:</label><br>
        <input type="text" id="no_kk" name="no_kk" value="{{empty(session()->get('formState')['no_kk']) ? "" : session()->get('formState')['no_kk'] }}"><br>

        <label for="kepala_keluarga">Kepala Keluarga:</label><br>
        <input type="text" id="kepala_keluarga" name="kepala_keluarga" value="{{empty(session()->get('formState')['kepala_keluarga']) ? "" : session()->get('formState')['kepala_keluarga'] }}"><br>

        <label for="alamat">Alamat:</label><br>
        <textarea id="alamat" name="alamat" value="{{empty(session()->get('formState')['alamat']) ? "" : session()->get('formState')['alamat'] }}"></textarea><br>

        <label for="RT">RT:</label><br>
        <input type="number" id="RT" name="RT" value="{{$default['rt']}}"><br>

        <label for="RW">RW:</label><br>
        <input type="number" id="RW" name="RW" value="{{$default['rw']}}"><br>

        <label for="kode_pos">Kode Pos:</label><br>
        <input type="text" id="kode_pos" name="kode_pos" value="{{$default['kode_pos']}}"><br>

        <label for="kelurahan">Kelurahan:</label><br>
        <input type="text" id="kelurahan" name="kelurahan" value="{{$default['kelurahan']}}"><br>

        <label for="kecamatan">Kecamatan:</label><br>
        <input type="text" id="kecamatan" name="kecamatan" value="{{$default['kecamatan']}}"><br>

        <label for="kota">Kota:</label><br>
        <input type="text" id="kota" name="kota" value="{{$default['kota']}}"><br>

        <label for="provinsi">Provinsi:</label><br>
        <input type="text" id="provinsi" name="provinsi" value="{{$default['provinsi']}}"><br>

        <label for="image_kk">Foto KK:</label><br>
        <input type="file" id="image_kk" name="image_kk"><br>

        <label for="tagihan_listrik">Tagihan Listrik:</label><br>
        <input type="number" id="tagihan_listrik" name="tagihan_listrik" value="{{empty(session()->get('formState')['tagihan_listrik']) ? "" : session()->get('formState')['tagihan_listrik'] }}"><br>

        <label for="luas_bangunan">Luas Bangunan:</label><br>
        <input type="number" id="luas_bangunan" name="luas_bangunan" value="{{empty(session()->get('formState')['luas_bangunan']) ? "" : session()->get('formState')['luas_bangunan'] }}"><br>

        <br><br>
        <input type="submit" value="Submit">
    </form>
    <h2>Daftar Warga</h2>
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Status Keluarga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarWarga as $warga)
            <tr>
                <td>{{$loop->index}}</td>
                <td>{{$warga->NIK}}</td>
                <td>{{$warga->nama}}</td>
                <td>{{$warga->status_keluarga}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="tambahAnggotaKeluarga()">Tambah Anggota Keluarga</button>
    <script>
        function getFormData($form){
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};
            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });
            return indexed_array;
        }
        function tambahAnggotaKeluarga(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var kk = document.getElementById("no_kk");
            var url = "/penduduk/warga/tambah/"+kk.value;

            data = $('#formdata');
            data = getFormData(data);
            $.ajax({
                type: "POST",
                url: "/penduduk/keluarga/tambah/save-state",
                data: JSON.stringify(data),
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    window.location.href = url;
                }
            });
        }
    </script>
    {{-- // {{dd($daftarWarga)}} --}}
</body>
</html>
