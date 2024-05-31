<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARAS Method</title>
    <style>
        /* Styling untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
        h2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h1><a href="{{ route('spk.aras') }}">PERHITUNGAN RANGKING ARAS</a></h1>

<h2>Matriks Awal</h2>

<table>
    <thead>
        <tr>
            <th>Alternatif</th>
            @foreach($namaKriteria as $kriteria)
                <th>{{ $kriteria }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($matriks as $no_kk => $nilai)
            <tr>
                <td>{{ $no_kk }}</td>
                @foreach($nilai as $nilai_kriteria)
                    <td>{{ $nilai_kriteria }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Normalisasi Matriks Keputusan</h2>

<table>
    <thead>
        <tr>
            <th>Alternatif</th>
            @foreach($namaKriteria as $kriteria)
                <th>{{ $kriteria }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($R as $no_kk => $nilai)
            <tr>
                <td>{{ $no_kk }}</td>
                @foreach($nilai as $nilai_kriteria)
                    <td>{{ $nilai_kriteria }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Nilai Si</h2>

<table>
    <thead>
        <tr>
            <th>Alternatif</th>
            <th>Nilai Si</th>
        </tr>
    </thead>
    <tbody>
        @foreach($S as $no_kk => $nilai_si)
            <tr>
                <td>{{ $no_kk }}</td>
                <td>{{ $nilai_si }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Nilai Sij</h2>

<table>
    <thead>
        <tr>
            <th>Alternatif</th>
            @foreach($namaKriteria as $kriteria)
                <th>{{ $kriteria }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($S0 as $no_kk => $nilai)
            <tr>
                <td>{{ $no_kk }}</td>
                @foreach($nilai as $nilai_sij)
                    <td>{{ $nilai_sij }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Nilai Ei</h2>

<table>
    <thead>
        <tr>
            <th>Kriteria</th>
            <th>Nilai Ei</th>
        </tr>
    </thead>
    <tbody>
        @foreach($E as $index => $nilai_ei)
            <tr>
                <td>{{ $namaKriteria[$index] }}</td>
                <td>{{ $nilai_ei }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Bobot</h2>

<table>
    <thead>
        <tr>
            <th>Kriteria</th>
            <th>Bobot MEREC</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bobot as $index => $nilai_bobot)
            <tr>
                <td>{{ $namaKriteria[$index] }}</td>
                <td>{{ $nilai_bobot }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
