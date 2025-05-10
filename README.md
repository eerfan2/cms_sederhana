# CMS Sederhana

CMS (Content Management System) sederhana yang dibangun dengan PHP dan AdminLTE.

## Fitur

- Manajemen artikel (CRUD)
- Manajemen kategori
- Manajemen pengguna
- Editor WYSIWYG untuk konten artikel
- Upload gambar
- Sistem login
- Tampilan admin yang responsif dengan AdminLTE

## Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache/Nginx)
- Ekstensi PHP yang diperlukan:
  - mysqli
  - gd
  - fileinfo

## Instalasi

1. Clone repository ini ke direktori web server Anda
2. Buat database baru di MySQL
3. Import file `database.sql` ke database yang telah dibuat
4. Salin file `config/database.example.php` menjadi `config/database.php`
5. Sesuaikan konfigurasi database di `config/database.php`
6. Pastikan folder `uploads` memiliki permission yang benar (777)
7. Akses CMS melalui browser

## Login Default

- Username: admin
- Password: password

## Struktur Folder

```
cms_sederhana/
├── config/
│   └── database.php
├── includes/
│   └── functions.php
├── uploads/
├── artikel.php
├── index.php
├── login.php
├── logout.php
├── tambah_artikel.php
└── database.sql
```

## Keamanan

- Password di-hash menggunakan bcrypt
- Input di-sanitasi untuk mencegah SQL injection
- Validasi file upload
- Session management

## Lisensi

Proyek ini dilisensikan di bawah MIT License. 