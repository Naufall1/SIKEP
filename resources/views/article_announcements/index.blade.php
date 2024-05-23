<!DOCTYPE html>
<html>
<head>
    <title>Article Announcements</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Article Announcements</h1>
        <a href="{{ route('article_announcements.create') }}" class="btn btn-primary mb-3">Berita Baru +</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Tanggal Publish</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcements as $announcement)
                    <tr>
                        <td>{{ $announcement->kode }}</td>
                        <td>{{ $announcement->judul }}</td>
                        <td>{{ $announcement->penulis }}</td>
                        <td>{{ $announcement->tanggal_publish }}</td>
                        <td>
                            <a href="{{ route('article_announcements.show', $announcement->kode) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('article_announcements.edit', $announcement->kode) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('article_announcements.destroy', $announcement->kode) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
