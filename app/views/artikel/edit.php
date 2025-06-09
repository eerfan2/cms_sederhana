<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel - CMS Sederhana</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Artikel</h1>
        <form action="<?= BASEURL; ?>/artikel/edit/<?= $data['artikel']['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul Artikel</label>
                <input type="text" name="judul" id="judul" class="form-control" value="<?= $data['artikel']['judul']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="id_kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach($data['kategori'] as $kategori) : ?>
                        <option value="<?= $kategori['id']; ?>" <?= ($kategori['id'] == $data['artikel']['id_kategori']) ? 'selected' : ''; ?>>
                            <?= $kategori['nama_kategori']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="isi">Isi Artikel</label>
                <textarea name="isi" id="isi" class="form-control" rows="10" required><?= $data['artikel']['isi']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <?php if(!empty($data['artikel']['gambar'])) : ?>
                    <img src="<?= BASEURL; ?>/images/<?= $data['artikel']['gambar']; ?>" alt="Preview" style="max-width: 200px; margin: 10px 0;">
                <?php endif; ?>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                <input type="hidden" name="gambar_lama" value="<?= $data['artikel']['gambar']; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= BASEURL; ?>/artikel" class="btn btn-danger">Kembali</a>
        </form>
    </div>
</body>
</html> 