<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Cek apakah user sudah login
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = clean($_GET['id']);
    
    // Cek apakah kategori digunakan di artikel
    $query = "SELECT COUNT(*) as total FROM artikel WHERE kategori_id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row['total'] > 0) {
        $_SESSION['error'] = "Kategori tidak dapat dihapus karena masih digunakan dalam artikel!";
    } else {
        // Hapus kategori
        $query = "DELETE FROM kategori WHERE id = '$id'";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Kategori berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus kategori: " . mysqli_error($conn);
        }
    }
}

header("Location: kategori.php");
exit();
?> 