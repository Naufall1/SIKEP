<!DOCTYPE html>
<html>
<head>
    <title>Perangkingan ARAS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Matriks Awal</h1>
    <a href="{{ route('spk.merec') }}">Bobot</a>
    <table border="1">
        <thead>
            <tr>
                <th>Alternatif (NO KK)</th>
                <th>Kriteria</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matriks as $no_kk => $matriks )
                <tr>
                    <td>{{ $no_kk }}</td>
                    {{-- {{dd($nilaiARAS[0])}}; --}}
                    <td>{{ $nilaiARAS[0] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Matriks Ternormalisasi</h1>
    <a href="{{ route('spk.merec') }}">Bobot</a>
    <table border="1">
        <thead>
            <tr>
                <th>Alternatif (NO KK)</th>
                <th>Kriteria</th>
            </tr>
        </thead>
        <tbody>
            @foreach($normalizedMatrix as $no_kk => $nilaiARAS )
                <tr>
                    <td>{{ $no_kk }}</td>
                    {{-- {{dd($nilaiARAS[0])}}; --}}
                    <td>{{ $nilaiARAS[0] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Perangkingan Metode ARAS</h1>
    <a href="{{ route('spk.merec') }}">Bobot</a>
    <table border="1">
        <thead>
            <tr>
                <th>Alternatif (NO KK)</th>
                <th>Skore ARAS</th>
                <th>Rank</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rankings as $no_kk => $nilaiARAS)
                <tr>
                    <td>{{ $no_kk }}</td>
                    <td>{{ $nilaiARAS }}</td>
                    <td>{{ $loop->iteration }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
