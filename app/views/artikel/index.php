<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel - CMS Sederhana</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Artikel</h1>
        <a href="<?= BASEURL; ?>/artikel/tambah" class="btn btn-primary">Tambah Artikel</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach($data['artikel'] as $artikel) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $artikel['judul']; ?></td>
                    <td><?= $artikel['nama_kategori']; ?></td>
                    <td><?= date('d/m/Y', strtotime($artikel['tanggal'])); ?></td>
                    <td>
                        <a href="<?= BASEURL; ?>/artikel/edit/<?= $artikel['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="<?= BASEURL; ?>/artikel/hapus/<?= $artikel['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 