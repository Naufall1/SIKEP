<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan ARAS</title>
    <style>
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
    <h1><a href="{{ route('spk.merec') }}">PERHITUNGAN BOBOT MEREC</a></h1>

    <h2>Bobot dari MEREC</h2>
    <table>
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Bobot</th>
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

    @if(isset($normalizedMatrix))
        <h2>Normalisasi Matriks Keputusan dengan Bobot</h2>
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
                @foreach($normalizedMatrix as $no_kk => $nilai)
                    <tr>
                        <td>{{ $no_kk }}</td>
                        @foreach($nilai as $nilai_kriteria)
                            <td>{{ $nilai_kriteria }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(isset($idealSolution))
        <h2>Step 2: Hitung Skor Ideal</h2>
        <table>
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th>Skor Ideal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($idealSolution as $key => $value)
                    <tr>
                        <td>{{ $namaKriteria[$key] }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(isset($alternativesScores))
        <h2>Step 3: Hitung Skor Alternatif</h2>
        <table>
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Skor Alternatif</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alternativesScores as $no_kk => $score)
                    <tr>
                        <td>{{ $no_kk }}</td>
                        <td>{{ $score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(isset($rankings))
        <h2>Step 4: Hitung Nilai Utilitas dan Lakukan Perangkingan</h2>
        <table>
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai Utilitas</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rankings as $no_kk => $ranking)
                    <tr>
                        <td>{{ $no_kk }}</td>
                        <td>{{ $ranking }}</td>
                        <td>{{ $loop->iteration }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
