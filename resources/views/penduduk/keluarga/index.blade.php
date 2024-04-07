<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Keluarga</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Data Keluarga</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No. KK</th>
                    <th scope="col">Kepala Keluarga</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">RT</th>
                    <th scope="col">RW</th>
                    <th scope="col">Kode Pos</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Tagihan Listrik</th>
                    <th scope="col">Luas Bangunan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keluarga as $k)
                <tr>
                    <td>{{ $k->no_kk }}</td>
                    <td>{{ $k->kepala_keluarga }}</td>
                    <td>{{ $k->alamat }}</td>
                    <td>{{ $k->RT }}</td>
                    <td>{{ $k->RW }}</td>
                    <td>{{ $k->kode_pos }}</td>
                    <td>{{ $k->kelurahan }}</td>
                    <td>{{ $k->kecamatan }}</td>
                    <td>{{ $k->kota }}</td>
                    <td>{{ $k->provinsi }}</td>
                    <td>{{ $k->tagihan_listrik }}</td>
                    <td>{{ $k->luas_bangunan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
