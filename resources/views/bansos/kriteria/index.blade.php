<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kriteria</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Daftar Kriteria</h1>
    <table>
        <thead>
            <tr>
                <th>Kepala Keluarga</th>
                <th>Tagihan Listrik</th>
                <th>Luas Bangunan</th>
                <th>Total Penghasilan Keluarga</th>
                <th>Jumlah Warga dengan Penghasilan</th>
                <th>Tanggungan</th>
                <th>Jumlah Bersekolah</th>
                <th>Aksi</th> <!-- Kolom tambahan untuk tombol edit -->
            </tr>
        </thead>
        <tbody>
            @foreach($dataKeluarga as $k)
            <tr>
                <td>{{ $k->kepala_keluarga }}</td>
                <td>{{ $k->tagihan_listrik }}</td>
                <td>{{ $k->luas_bangunan }} m</td>
                <td>{{ $k->total_penghasilan }}</td>
                <td>{{ $k->jumlah_warga_berpenghasilan }}</td>
                <td>{{ $k->tanggungan }}</td>
                <td>{{ $k->jumlah_warga_bersekolah }}</td>
                <td><a href="{{ route('kriteriaForm', $k->no_kk) }}">Edit</a></td> <!-- Tombol edit dengan route yang sesuai -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
