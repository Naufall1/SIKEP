<!DOCTYPE html>
<html>
<head>
    <title>Article Announcement Detail</title>
    <!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>{{ $announcement->judul }}</h1>
        <div class="row mt-3">
            <div class="col-md-6">
                <p><strong>Kode:</strong> {{ $announcement->kode }}</p>
                <p><strong>User ID:</strong> {{ $announcement->user_id }}</p>
                <p><strong>Kategori:</strong> {{ $announcement->kategori }}</p>
                <p><strong>Penulis:</strong> {{ $announcement->penulis }}</p>
                <p><strong>Tanggal Publish:</strong> {{ $announcement->tanggal_publish }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Tanggal Dibuat:</strong> {{ $announcement->tanggal_dibuat }}</p>
                <p><strong>Tanggal Edit:</strong> {{ $announcement->tanggal_edit }}</p>
                <p><strong>Status:</strong> {{ $announcement->status }}</p>
                <p><strong>Image URL:</strong> {{ $announcement->image_url }}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <p><strong>Isi:</strong></p>
                {!! $announcement->isi !!}
            </div>
        </div>
        <a href="{{ route('article_announcements.index') }}" class="btn btn-primary mt-3">Back to List</a>
    </div>
</body>
</html>
