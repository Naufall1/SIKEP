<!DOCTYPE html>
<html>
<head>
    <title>Edit Kriteria</title>
</head>
<body>
    <h1>Kriteria Keluarga</h1>
    <form action="{{ route('kriteriaUpdate', $dataKeluarga->no_kk) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="kepala_keluarga">Kepala Keluarga:</label>
        <input type="text" id="kepala_keluarga" name="kepala_keluarga" value="{{ $dataKeluarga->kepala_keluarga }}" disabled><br><br>

        <label for="tagihan_listrik">Tagihan Listrik:</label>
        <input type="text" id="tagihan_listrik" name="tagihan_listrik" value="{{ $dataKeluarga->tagihan_listrik }}"><br><br>

        <label for="luas_bangunan">Luas Bangunan:</label>
        <input type="text" id="luas_bangunan" name="luas_bangunan" value="{{ $dataKeluarga->luas_bangunan }}"><br><br>

        <h1>Kriteria Anggota Keluarga</h1>
        @foreach($dataWarga as $anggota)
            <label for="nik">NIK:</label>
            {{-- kalo ga readonly error y sayang --}}
            <input type="text" id="nik" name="nik[]" value="{{ $anggota->nik }}" readonly><br><br>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama[]" value="{{ $anggota->nama }}" readonly><br><br>

            <label for="status_keluarga">Status Keluarga:</label>
            <input type="text" id="status_keluarga" name="status_keluarga[]" value="{{ $anggota->status_keluarga }}" readonly><br><br>

            <label for="jenis_pekerjaan">Jenis Pekerjaan:</label>
            <input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan[]" value="{{ $anggota->jenis_pekerjaan }}"><br><br>

            <label for="penghasilan">Penghasilan:</label>
            <input type="text" id="penghasilan" name="penghasilan[]" value="{{ $anggota->penghasilan }}"><br><br>

            <h5>----------------------</h5>
        @endforeach

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
