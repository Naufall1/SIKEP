<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilku</title>
</head>
<body>
    <h1>Profil saya</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Aksi</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->keterangan }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
