<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel - CMS Sederhana</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Artikel</h1>
        <form action="<?= BASEURL; ?>/artikel/tambah" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul Artikel</label>
                <input type="text" name="judul" id="judul" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="id_kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach($data['kategori'] as $kategori) : ?>
                        <option value="<?= $kategori['id']; ?>"><?= $kategori['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="isi">Isi Artikel</label>
                <textarea name="isi" id="isi" class="form-control" rows="10" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= BASEURL; ?>/artikel" class="btn btn-danger">Kembali</a>
        </form>
    </div>
</body>
</html> 