<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Cek apakah user sudah login
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$error = '';
$success = '';

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = clean($_POST['judul']);
    $konten = clean($_POST['konten']);
    $kategori_id = clean($_POST['kategori_id']);
    $status = clean($_POST['status']);
    $user_id = $_SESSION['user_id'];
    
    // Validasi input
    if (empty($judul) || empty($konten) || empty($kategori_id)) {
        $error = "Semua field harus diisi!";
    } else {
        // Upload gambar jika ada
        $gambar = '';
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $upload_result = uploadImage($_FILES['gambar']);
            if ($upload_result['success']) {
                $gambar = $upload_result['filename'];
            } else {
                $error = $upload_result['message'];
            }
        }
        
        if (empty($error)) {
            // Insert artikel ke database
            $query = "INSERT INTO artikel (judul, konten, gambar, kategori_id, user_id, status, tanggal) 
                     VALUES ('$judul', '$konten', '$gambar', '$kategori_id', '$user_id', '$status', NOW())";
            
            if (mysqli_query($conn, $query)) {
                $success = "Artikel berhasil ditambahkan!";
            } else {
                $error = "Gagal menambahkan artikel: " . mysqli_error($conn);
            }
        }
    }
}

// Ambil semua kategori
$categories = getAllCategories();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel - CMS Sederhana</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index.php" class="brand-link">
                <span class="brand-text font-weight-light">CMS Sederhana</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="artikel.php" class="nav-link active">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Artikel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kategori.php" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="users.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Tambah Artikel</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($success)): ?>
                                        <div class="alert alert-success"><?php echo $success; ?></div>
                                    <?php endif; ?>

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="judul">Judul Artikel</label>
                                            <input type="text" class="form-control" id="judul" name="judul" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="kategori_id">Kategori</label>
                                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category['id']; ?>">
                                                        <?php echo htmlspecialchars($category['nama_kategori']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="konten">Konten</label>
                                            <textarea class="form-control" id="konten" name="konten" rows="10" required></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="gambar">Gambar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                                    <label class="custom-file-label" for="gambar">Pilih file</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="draft">Draft</option>
                                                <option value="published">Published</option>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="artikel.php" class="btn btn-default">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; <?php echo date('Y'); ?> CMS Sederhana</strong>
        </footer>
    </div>

    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#konten').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            
            // Update nama file yang dipilih
            $('input[type="file"]').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>
</body>
</html> 