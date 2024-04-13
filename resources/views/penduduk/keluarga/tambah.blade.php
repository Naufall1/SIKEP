@extends('layout.layout', ['isForm' => true])

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="tw-pt-[100px] tw-mx-5 md:tw-mx-auto md:tw-w-[702px] tw-flex tw-flex-col tw-gap-2 tw-pb-10">
        <p class="tw-breadcrumb tw-text-n500">Daftar Penduduk /
            <span class="tw-font-bold tw-text-b500">Tambah Keluarga</span>
        </p>

        <div class="">

            <h1 class="tw-h1 tw-mb-3">Tambah Data</h1>

            <form class="tw-flex tw-flex-col tw-gap-7" action="{{ route('keluarga-tambah') }}" method="POST"
                enctype="multipart/form-data" id="formdata">
                @csrf

                <div id="formInput" class="tw-flex tw-flex-col tw-gap-7 tw-divide-y-[1.5px] tw-divide-n400">

                    <div class="md:tw-w-80 tw-flex tw-flex-col tw-gap-2">
                        <h2 class="">Data Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">


                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="jenis_data">Jenis Data
                                <div class="tw-w-full tw-flex tw-flex-col tw-relative tw-group">
                                    <select class="item tw-input-enabled tw-appearance-none" name="jenis_data" id="jenis_data">
                                        <option value="data_baru"
                                            {{ empty(session()->get('formState')['jenis_data']) ? '' : (session()->get('formState')['jenis_data'] == 'data_baru' ? 'selected' : '') }}>
                                            KK Baru</option>
                                        <option value="data_lama"
                                            {{ empty(session()->get('formState')['jenis_data']) ? '' : (session()->get('formState')['jenis_data'] == 'data_lama' ? 'selected' : '') }}>
                                            KK Lama</option>
                                    </select>
                                    <span
                                        class="toggleDrop tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-3 tw-flex tw-items-center tw-pl-2">
                                        <img id="arrowDown" src="{{ asset('assets/icons/actionable/arrow-down-1.svg') }}"
                                            alt="\/">
                                    </span>
                                </div>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="no_kk">No KK
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan No KK" type="text"
                                    id="no_kk" name="no_kk"
                                    value="{{ empty(session()->get('formState')['no_kk']) ? '' : session()->get('formState')['no_kk'] }}">
                                <select class="tw-hidden tw-placeholder" name="no_kk" id="no_kk-list" disabled>
                                    <option value="no" disabled selected>Pilih KK</option>
                                </select>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kepala_keluarga">Kepala Keluarga
                                <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan Kepala Keluarga"
                                    type="text" id="kepala_keluarga" name="kepala_keluarga"
                                    value="{{ empty(session()->get('formState')['kepala_keluarga']) ? '' : session()->get('formState')['kepala_keluarga'] }}">
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="alamat">Alamat
                                <textarea class="tw-input-enabled tw-pt-[10px] tw-placeholder" placeholder="Masukkan Alamat" type="text"
                                    id="alamat" name="alamat">{{ empty(session()->get('formState')['alamat']) ? '' : session()->get('formState')['alamat'] }}</textarea>
                            </label>

                            {{-- <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="RT">RT
                            <input class="tw-input-enabled tw-placeholder" placeholder="Masukkan RT" type="text"
                                id="RT" name="RT">
                        </label> --}}

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="RT">RT
                                <select class="tw-input-enabled tw-placeholder" name="RT" id="RT">
                                    <option value="1">001</option>
                                    <option value="2">002</option>
                                    <option value="3">003</option>
                                    <option value="4">004</option>
                                    <option value="5">005</option>
                                    <option value="6">006</option>
                                    <option value="7">007</option>
                                    <option value="8">008</option>
                                    <option value="9">009</option>
                                    <option value="10">010</option>
                                    <option value="11">011</option>
                                </select>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="RW">RW
                                <input class="tw-input-disabled tw-placeholder" placeholder="Masukkan RW" type="text"
                                    id="RW" name="RW" value="{{ $default['rw'] }}" disabled>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kode_pos">Kode POS
                                <input class="tw-input-disabled tw-placeholder" type="text" id="kode_pos"
                                    name="kode_pos" value="{{ $default['kode_pos'] }}" disabled>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kelurahan">Kelurahan
                                <input class="tw-input-disabled tw-placeholder" type="text" id="kelurahan"
                                    name="kelurahan" value="{{ $default['kelurahan'] }}" disabled>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kecamatan">Kecamatan
                                <input class="tw-input-disabled tw-placeholder" type="text" id="kecamatan"
                                    name="kecamatan" value="{{ $default['kecamatan'] }}" disabled>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="kota">Kota
                                <input class="tw-input-disabled tw-placeholder" type="text" id="kota"
                                    name="kota" value="{{ $default['kota'] }}" disabled>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="provinsi">Provinsi
                                <input class="tw-input-disabled tw-placeholder" type="text" id="provinsi"
                                    name="provinsi" value="{{ $default['provinsi'] }}" disabled>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="tagihan_listrik">Tagihan Listrik
                                <div class="tw-relative tw-flex tw-w-full">
                                    <input type="text" id="tagihan_listrik" name="tagihan_listrik"
                                        placeholder="1000000" class="tw-input-enabled tw-pl-8 tw-pr-3" type="number"
                                        value="{{ empty(session()->get('formState')['tagihan_listrik']) ? '' : session()->get('formState')['tagihan_listrik'] }}">
                                    </input>
                                    <span
                                        class="tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-left-[6px] tw-flex tw-items-center tw-cursor-pointer">
                                        <img class="tw-w-7 tw-bg-cover"
                                            src="{{ asset('assets/icons/actionable/rupiah.svg') }}" alt="Rp">
                                    </span>
                                </div>
                            </label>

                            <label class="tw-label tw-flex tw-flex-col tw-gap-2" for="luas_bangunan">Luas Bangunan
                                <input class="tw-input-enabled tw-placeholder" type="number" id="luas_bangunan"
                                    name="luas_bangunan"
                                    value="{{ empty(session()->get('formState')['luas_bangunan']) ? '' : session()->get('formState')['luas_bangunan'] }}">
                            </label>

                        </div>
                    </div>

                    <div id="anggota_keluarga"
                        class="tw-flex tw-pt-6 tw-flex-col tw-gap-3 tw-overflow-hidden tw-overflow-x-scroll">
                        <h2 class="">Anggota Keluarga</h2>
                        <div class="tw-flex tw-flex-col tw-gap-3">


                            <table class="tw-w-[702px] md:tw-w-full">
                                {{-- <thead class="tw-rounded-lg"> --}}
                                <tr class="tw-h-11 tw-bg-n300 tw-rounded-lg">
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Status Keluarga</th>
                                    <th class="tw-w-[108px]"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftarWarga as $warga)
                                        <tr class="tw-h-16 hover:tw-bg-n300 tw-border-b-[1.5px] tw-border-n400">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $warga->NIK }}</td>
                                            <td>{{ $warga->nama }}</td>
                                            <td>{{ $warga->status_keluarga }}</td>
                                            <td
                                                class="tw-w-[140px] tw-h-16 tw-flex tw-items-center tw-justify-center tw-gap-2">
                                                <a href=""
                                                    class="tw-h-10 tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center">
                                                    Lihat
                                                </a>
                                                <a href="{{ route('removeAnggotaKeluarga', $loop->index) }}"
                                                    class="tw-h-10 tw-px-2 tw-bg-r500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-r600 active:tw-bg-r700 tw-flex tw-items-center">
                                                    <img class="tw-h-5 tw-bg-cover"
                                                        src="{{ asset('assets/icons/actionable/trash.svg') }}"
                                                        alt="del">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="tw-h-16 tw-border-b-[1.5px] tw-border-n400 hover:tw-bg-n300">
                                        <td class="tw-h-16 tw-relative" colspan="5">
                                            <a href="#"
                                                class=" tw-absolute tw-top-1/2 -tw-translate-y-1/2 tw-right-1/2 tw-translate-x-1/2  tw-h-10 tw-w-fit tw-px-4 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-[14px] tw-rounded-md hover:tw-bg-b600 active:tw-bg-b700 tw-flex tw-items-center"
                                                onclick="tambahAnggotaKeluarga()">
                                                Tambah
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                <div class="tw-flex tw-justify-between  tw-w-full md:tw-w-fit md:tw-gap-3 md:tw-justify-start">
                    <a href="{{ route('warga') }}"
                        class="tw-flex tw-items-center tw-relative tw-min-w-16 tw-px-5 tw-h-11 md:tw-pl-12 md:tw-pr-6 tw-bg-n100 tw-border-2 tw-border-n500 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-border-n800 hover:tw-bg-n200 active:tw-bg-n300 active:tw-border-n1000"
                        type="button">
                        <span
                            class="md:tw-absolute md:tw-top-1/2 md:-tw-translate-y-1/2 md:tw-left-2 tw-flex tw-items-center md:tw-pl-2 tw-cursor-pointer">
                            <img src="{{ asset('assets/icons/actionable/arrow-left.svg') }}" alt="back">
                        </span>
                        <span class="tw-hidden md:tw-inline-block">
                            Kembali
                        </span>
                    </a>
                    <button
                        class="tw-h-11 tw-px-6 tw-bg-b500 tw-text-n100 tw-font-sans tw-font-bold tw-text-base tw-rounded-full hover:tw-bg-b600 active:tw-bg-b700"
                        type="submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>
    {{-- {{dd(session()->get('formState'))}} --}}
    <script>
        $(document).ready(function() {
            changeJenisData(
                '{{ empty(session()->get('formState')['jenis_data']) ? '' : session()->get('formState')['jenis_data'] }}'
                );
            selectKK(
                '{{ empty(session()->get('formState')['no_kk']) ? '' : session()->get('formState')['no_kk'] }}',
                '{{ empty(session()->get('formState')['jenis_data']) ? '' : session()->get('formState')['jenis_data'] }}'
                );
            selectRT('{{ empty(session()->get('formState')['RT']) ? '' : session()->get('formState')['RT'] }}')
        });

        function getFormData($form) {
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};
            $.map(unindexed_array, function(n, i) {
                indexed_array[n['name']] = n['value'];
            });
            return indexed_array;
        }

        function tambahAnggotaKeluarga() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var kk = document.getElementById("no_kk");
            var url = "/penduduk/warga/tambah/" + kk.value;

            data = $('#formdata');
            data = getFormData(data);
            $.ajax({
                type: "POST",
                url: "/penduduk/keluarga/tambah/save-state",
                data: JSON.stringify(data),
                dataType: "json",
                success: function(response) {
                    window.location.href = url;
                }
            });
        }

        function changeJenisData(data) {
            if (data == 'data_lama') {
                $('#formData').attr('action', '{{ route('pindahKK') }}');
                $('#no_kk').removeClass('tw-input-enabled');
                $('#no_kk').attr('type', 'hidden');
                $('#no_kk').prop('disabled', true);

                $('#alamat').removeClass('tw-input-enabled');
                $('#alamat').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#alamat').attr('placeholder', 'Pilih NIK');
                $('#alamat').prop('disabled', true);

                $('#kepala_keluarga').removeClass('tw-input-enabled');
                $('#kepala_keluarga').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#kepala_keluarga').attr('placeholder', 'Pilih NIK');
                $('#kepala_keluarga').prop('readonly', true);

                $('#RT').removeClass('tw-input-enabled');
                $('#RT').addClass('tw-input-disabled placeholder:tw-text-n600');
                $('#RT').attr('placeholder', 'Pilih No KK');
                $('#RT').prop('disabled', true);

                $('#no_kk-list').addClass('tw-input-enabled');
                $('#no_kk-list').removeClass('tw-hidden');
                $('#no_kk-list').prop('disabled', false);
                // $('#no_kk-list').val('no').change();
                $.ajax({
                    type: "GET",
                    url: "/api/keluarga",
                    success: function(response) {
                        // console.log(response);
                        response.forEach(keluarga => {
                            let optionHTML =
                                `<option value="${keluarga.no_kk}">${keluarga.no_kk} - ${keluarga.kepala_keluarga}</option>`;
                            $('#no_kk-list').append(optionHTML);
                        });
                        $('#no_kk-list').val(
                            '{{ empty(session()->get('formState')['no_kk']) ? 'no' : (session()->get('formState')['jenis_data'] == 'data_baru' ? 'no' : session()->get('formState')['no_kk']) }}'
                            ).change();
                        // $('#no_kk-list').val('no').change();
                        // console.log('{{ empty(session()->get('formState')['no_kk']) ? 'no' : session()->get('formState')['no_kk'] }}');
                    }
                });
            }
            if (data == 'data_baru') {
                $('#formData').attr('action', '{{ route('tambah-warga-post') }}');
                $('#no_kk').addClass('tw-input-enabled');
                $('#no_kk').attr('type', 'text');
                $('#no_kk').prop('disabled', false);


                $('#alamat').addClass('tw-input-enabled');
                $('#alamat').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#alamat').attr('placeholder', 'Masukkan Alamat');
                $('#alamat').prop('disabled', false);

                $('#kepala_keluarga').addClass('tw-input-enabled');
                $('#kepala_keluarga').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#kepala_keluarga').attr('placeholder', 'Masukkan Kepala Keluarga');
                $('#kepala_keluarga').prop('readonly', false);

                $('#RT').val('001');
                $('#RT').addClass('tw-input-enabled');
                $('#RT').removeClass('tw-input-disabled placeholder:tw-text-n600');
                $('#RT').attr('placeholder', 'Masukkan Tempat Lahir');
                $('#RT').prop('disabled', false);


                $('#no_kk-list').removeClass('tw-input-enabled');
                $('#no_kk-list').addClass('tw-hidden');
                $('#no_kk-list').prop('disabled', true);
            }
        }

        function resetNonDefaultValues() {
            $('#no_kk').val('');
            $('#alamat').val('');
            $('#kepala_keluarga').val('');
            $('#RT').val('');
            $('#tagihan_listrik').val('');
            $('#luas_bangunan').val('');
        }

        function selectRT(rt) {
            console.log(rt);
            $('select#RT').val(rt).change();
        }

        function selectKK(no_kk, jenis_data) {
            console.log(jenis_data);
            if (jenis_data == 'data_lama') {
                if (no_kk != '') {
                    console.log(no_kk);
                    $.ajax({
                        type: "GET",
                        url: "/api/keluarga/" + no_kk,
                        success: function(response) {
                            $.each(response, function(key, val) {
                                if (val === null) {
                                    // console.log(val);
                                    $('#' + key).attr('placeholder', '-');
                                }
                                $('#' + key).val(val);
                            });
                            selectRT(response.RT);
                        }
                    });
                }
            }
        }

        $('#jenis_data').on('change', function() {
            changeJenisData(this.value);
            resetNonDefaultValues();
        });

        $('#no_kk-list').on('change', function() {
            selectKK(this.value, 'data_lama');
        });
    </script>
@endsection

{{-- <!DOCTYPE html>
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
                    if (kk.value != '') {
                        window.location.href = url;
                    } else {
                        alert('Nomor KK Harus diisi');
                    }
                }
            });
        }
    </script>
    // {{dd($daftarWarga)}}
</body>
</html> --}}
