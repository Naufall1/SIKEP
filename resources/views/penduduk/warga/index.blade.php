<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga</title>
</head>
<body>
    <h1>Data Warga</h1>
    <table border="1">
        <thead>
            <tr>
                <th>NIK</th>
                <th>No KK</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Status Perkawinan</th>
                <th>Status Keluarga</th>
                <th>Status Warga</th>
                <th>Jenis Pekerjaan</th>
                <th>Penghasilan</th>
                <th>Kewarganegaraan</th>
                <th>Pendidikan</th>
                <th>No Paspor</th>
                <th>No KITAS</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($warga as $w)
            <tr>
                <td>{{ $w->NIK }}</td>
                <td>{{ $w->no_kk }}</td>
                <td>{{ $w->nama }}</td>
                <td>{{ $w->tempat_lahir }}</td>
                <td>{{ $w->tanggal_lahir }}</td>
                <td>{{ $w->jenis_kelamin }}</td>
                <td>{{ $w->agama }}</td>
                <td>{{ $w->status_perkawinan }}</td>
                <td>{{ $w->status_keluarga }}</td>
                <td>{{ $w->status_warga }}</td>
                <td>{{ $w->jenis_pekerjaan }}</td>
                <td>{{ $w->penghasilan }}</td>
                <td>{{ $w->kewarganegaraan }}</td>
                <td>{{ $w->pendidikan }}</td>
                <td>{{ $w->no_paspor }}</td>
                <td>{{ $w->no_kitas }}</td>
                <td>{{ $w->nama_ayah }}</td>
                <td>{{ $w->nama_ibu }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
