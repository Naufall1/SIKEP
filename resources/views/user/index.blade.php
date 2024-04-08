<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilku</title>
</head>
<body>
    <h1>Profil saya</h1>
    <div>
        <strong>Nama:</strong> {{ $user->nama }}<br>
        <strong>Username:</strong> {{ $user->username }}<br>
        <strong>Jabatan:</strong> {{ $user->level_nama }}<br>
        <strong>Keterangan:</strong> {{ $user->keterangan }}<br>
        <h2>-------------</h2>
        <a href="{{ route('profilFormEdit', ['user_id' => $user->user_id]) }}">Edit Profil</a>
    </div>
</body>
</html>
