<?php
// Fungsi untuk membersihkan input
function clean($string) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($string));
}

// Fungsi untuk mengecek login
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Fungsi untuk mendapatkan data user
function getUserData($user_id) {
    global $conn;
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// Fungsi untuk mendapatkan semua kategori
function getAllCategories() {
    global $conn;
    $query = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
    $result = mysqli_query($conn, $query);
    $categories = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    
    return $categories;
}

// Fungsi untuk mendapatkan artikel berdasarkan ID
function getArticleById($id) {
    global $conn;
    $id = clean($id);
    $query = "SELECT a.*, c.nama_kategori, u.username 
              FROM artikel a 
              LEFT JOIN kategori c ON a.kategori_id = c.id 
              LEFT JOIN users u ON a.user_id = u.id 
              WHERE a.id = '$id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// Fungsi untuk mendapatkan semua artikel
function getAllArticles($limit = null) {
    global $conn;
    $query = "SELECT a.*, c.nama_kategori, u.username 
              FROM artikel a 
              LEFT JOIN kategori c ON a.kategori_id = c.id 
              LEFT JOIN users u ON a.user_id = u.id 
              ORDER BY a.tanggal DESC";
    if ($limit) {
        $query .= " LIMIT $limit";
    }
    $result = mysqli_query($conn, $query);
    $articles = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $articles[] = $row;
    }
    return $articles;
}

// Fungsi untuk menampilkan pesan error
function showError($message) {
    return "<div class='alert alert-danger'>$message</div>";
}

// Fungsi untuk menampilkan pesan sukses
function showSuccess($message) {
    return "<div class='alert alert-success'>$message</div>";
}

// Fungsi untuk upload gambar
function uploadImage($file, $target_dir = "uploads/") {
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Cek apakah file adalah gambar
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return array("success" => false, "message" => "File bukan gambar.");
    }
    
    // Cek ukuran file
    if ($file["size"] > 5000000) {
        return array("success" => false, "message" => "Ukuran file terlalu besar.");
    }
    
    // Izinkan format file tertentu
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return array("success" => false, "message" => "Hanya file JPG, JPEG, PNG & GIF yang diizinkan.");
    }
    
    // Generate nama file unik
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return array("success" => true, "filename" => $new_filename);
    } else {
        return array("success" => false, "message" => "Gagal mengupload file.");
    }
}
?> 