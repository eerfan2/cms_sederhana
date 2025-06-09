<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori - CMS Sederhana</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Kategori</h1>
        <a href="<?= BASEURL; ?>/kategori/tambah" class="btn btn-primary">Tambah Kategori</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach($data['kategori'] as $kategori) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $kategori['nama_kategori']; ?></td>
                    <td>
                        <a href="<?= BASEURL; ?>/kategori/edit/<?= $kategori['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="<?= BASEURL; ?>/kategori/hapus/<?= $kategori['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 