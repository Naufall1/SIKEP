<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
</head>
<body>
    <h1>Edit Profilku</h1>
    {{-- flash message dadakno kudu dikei ngene wkw --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('profilUpdate', ['user_id' => $user->user_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="old_password">Password Lama:</label><br>
        <input type="password" id="old_password" name="old_password"><br>

        <label for="password">Password Baru:</label><br>
        <input type="password" id="password" name="password"><br>

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="{{ $user->username }}"><br>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" value="{{ $user->nama }}"><br>

        <label for="keterangan">Keterangan:</label><br>
        <textarea id="keterangan" name="keterangan">{{ $user->keterangan }}</textarea><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
