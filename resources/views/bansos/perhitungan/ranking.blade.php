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
        background-color: #f2f2f2;
    }

    h2 {
        margin-top: 20px;
    }
</style>
<h1><a href="{{ route('spk.merec') }}">PERHITUNGAN BOBOT MEREC</a></h1>
<h2>Bobot dari MEREC</h2>

<table>
    <thead>
        <tr>
            <th style="background-color: #4CAF50; color: white;">Kriteria</th>
            <th style="background-color: #4CAF50; color: white;">Bobot</th>
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
            <th style="background-color: #4CAF50; color: white;">Alternatif</th>
            @foreach($namaKriteria as $kriteria)
                <th style="background-color: #4CAF50; color: white;">{{ $kriteria }}</th>
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

<h2>Normalisasi Matriks Keputusan dengan Bobot</h2>

<table>
    <thead>
        <tr>
            <th style="background-color: #4CAF50; color: white;">Alternatif</th>
            @foreach($namaKriteria as $kriteria)
                <th style="background-color: #4CAF50; color: white;">{{ $kriteria }}</th>
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



<h2>Hasil Perangkingan</h2>

<table>
    <thead>
        <tr>
            <th style="background-color: #4CAF50; color: white;">Alternatif</th>
            <th style="background-color: #4CAF50; color: white;">Nilai Utilitas</th>
            <th style="background-color: #4CAF50; color: white;">Ranking</th>
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
