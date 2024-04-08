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
            <tr>
                <td>1</td>
                <td>1234567890123456</td>
                <td>John Doe</td>
                <td>Ayah</td>
            </tr>
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
                }
            });
        }
    </script>
</body>
</html>
