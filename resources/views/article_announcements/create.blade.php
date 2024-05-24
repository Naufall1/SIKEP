<!DOCTYPE html>
<html>
<head>
    <title>Create Article Announcement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.tiny.cloud/1/z0hhm5m2sapddlcptxbuiww7jy2drthhz0q3sk33ev5imf3n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            tinymce.init({
                selector: '#isi', // ID textarea yang ingin Anda ubah menjadi TinyMCE
                plugins: 'autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                setup: function (editor) {
                    editor.on('change', function (e) {
                        editor.save();
                    });
                }
            });

            var currentDate = new Date().toISOString().slice(0,10); // Get current date in YYYY-MM-DD format
            $('#tanggal_dibuat').val(currentDate);
            $('#tanggal_edit').val(currentDate);
            $('#tanggal_publish').val(currentDate);

            $('#article_form').submit(function(){
                // Tanggal edit diisi secara otomatis saat formulir disubmit
                $('#tanggal_edit').val(currentDate);
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1>Create Article Announcement</h1>
        <form action="{{ route('article_announcements.store') }}" method="POST" id="article_form">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="kode">Kode:</label>
                <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode') }}" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::user()->user_id }}">
            </div>
            <div class="form-group">
                <label for="isi">Isi:</label>
                <textarea name="isi" id="isi" class="form-control" required>{{ old('isi') }}</textarea>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <input type="text" name="kategori" id="kategori" class="form-control" value="{{ old('kategori') }}" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis:</label>
                <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis') }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal_publish">Tanggal Publish:</label>
                <input type="date" name="tanggal_publish" id="tanggal_publish" class="form-control" value="{{ old('tanggal_publish') }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal_dibuat">Tanggal Dibuat:</label>
                <input type="date" name="tanggal_dibuat" id="tanggal_dibuat" class="form-control" value="{{ old('tanggal_dibuat') }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal_edit">Tanggal Edit:</label>
                <input type="date" name="tanggal_edit" id="tanggal_edit" class="form-control" value="{{ old('tanggal_edit') }}">
            </div>
            <div class="form-group">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Ditampilkan" {{ old('status') == 'Ditampilkan' ? 'selected' : '' }}>Ditampilkan</option>
                    <option value="Disembunyikan" {{ old('status') == 'Disembunyikan' ? 'selected' : '' }}>Disembunyikan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="text" name="image_url" id="image_url" class="form-control" value="{{ old('image_url') }}">
            <div class="form-group">
                <label for="caption">Caption:</label>
                <input type="text" name="caption" id="caption" class="form-control" value="{{ old('caption') }}">
            </div>
            <button type="submit" class="btn btn-primary">Posting</button>
        </form>
    </div>
</body>
</html>
