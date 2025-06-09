<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CMS Sederhana</title>
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
    <style>
        .nav {
            background: #333;
            padding: 15px;
            margin-bottom: 20px;
        }
        .nav a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }
        .nav a:hover {
            color: #ddd;
        }
        .welcome {
            text-align: center;
            margin: 50px 0;
        }
    </style>
</head>
<body>
    <div class="nav">
        <a href="<?= BASEURL; ?>">Dashboard</a>
        <a href="<?= BASEURL; ?>/artikel">Artikel</a>
        <a href="<?= BASEURL; ?>/kategori">Kategori</a>
        <a href="<?= BASEURL; ?>/user">Users</a>
        <a href="<?= BASEURL; ?>/user/logout" style="float: right;">Logout</a>
    </div>

    <div class="container">
        <div class="welcome">
            <h1>Selamat Datang di CMS Sederhana</h1>
            <p>Ini adalah halaman utama CMS yang menggunakan pola MVC.</p>
        </div>

        <div class="dashboard-stats">
            <div class="row">
                <div class="col">
                    <h3>Menu Utama</h3>
                    <ul>
                        <li><a href="<?= BASEURL; ?>/artikel">Kelola Artikel</a></li>
                        <li><a href="<?= BASEURL; ?>/kategori">Kelola Kategori</a></li>
                        <li><a href="<?= BASEURL; ?>/user">Kelola Users</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 