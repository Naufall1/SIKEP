<!DOCTYPE html>
<html>
<head>
    <title>Bobot Kriteria - MEREC</title>
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
    <h1>Bobot Kriteria MEREC</h1>
    <a href="{{ route('spk.aras') }}">Hasil Ranking</a>
    <table>
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bobot as $key => $bobot)
            <tr>
                <td>{{ $namaKriteria[$key] }}</td>
                <td>{{ $bobot }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
