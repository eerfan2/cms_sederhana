<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - CMS Sederhana</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Kategori</h1>
        <form action="<?= BASEURL; ?>/kategori/tambah" method="POST">
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= BASEURL; ?>/kategori" class="btn btn-danger">Kembali</a>
        </form>
    </div>
</body>
</html> 