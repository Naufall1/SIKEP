<!-- resources/views/test.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Hasil Perhitungan</h2>
    <table>
        <thead>
            <tr>
                <th>No. KK</th>
                <th>Tagihan Listrik (K1)</th>
                <th>Luas Bangunan (K2)</th>
                <th>Total Penghasilan (K3)</th>
                <th>Jumlah Warga Berpenghasilan (K4)</th>
                <th>Tanggungan (K5)</th>
                <th>Jumlah yang Bersekolah (K6)</th>
            </tr>
        </thead>
        <tbody>
            {{-- @php
        dd($dataAlt);

            @endphp --}}
            @foreach($dataAlt as $no_kk => $alternatif)
            <tr>
                {{-- <td>{{ $alternatif['no_kk'] }}</td> --}}
                <td>{{$no_kk}}</td>
                <td>{{ $alternatif['K1'] }}</td>
                <td>{{ $alternatif['K2'] }}</td>
                <td>{{ $alternatif['K3'] }}</td>
                <td>{{ $alternatif['K4'] }}</td>
                <td>{{ $alternatif['K5'] }}</td>
                <td>{{ $alternatif['K6'] }}</td>

                {{-- <td>{{ $alternatif['nilai'] }}</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>No. KK</th>
                <th>Tagihan Listrik (K1)</th>
                <th>Luas Bangunan (K2)</th>
                <th>Total Penghasilan (K3)</th>
                <th>Jumlah Warga Berpenghasilan (K4)</th>
                <th>Tanggungan (K5)</th>
                <th>Jumlah yang Bersekolah (K6)</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            {{-- @php
        dd($matriks);

            @endphp --}}
            <br />
            Scaling
            @foreach($matriks as $no_kk => $alternatif)
            <tr>
                {{-- <td>{{ $alternatif['no_kk'] }}</td> --}}
                <td>{{$no_kk}}</td>
                <td>{{ $alternatif[0] }}</td>
                <td>{{ $alternatif[1] }}</td>
                <td>{{ $alternatif[2] }}</td>
                <td>{{ $alternatif[3] }}</td>
                <td>{{ $alternatif[4] }}</td>
                <td>{{ $alternatif[5] }}</td>
                <td>1</td>

                {{-- <td>{{ $alternatif['nilai'] }}</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
