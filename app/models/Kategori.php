<?php
class Kategori {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllKategori() {
        $query = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getKategoriById($id) {
        $query = "SELECT * FROM kategori WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahKategori($nama_kategori) {
        $query = "INSERT INTO kategori (nama_kategori) VALUES (:nama_kategori)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nama_kategori', $nama_kategori);
        return $stmt->execute();
    }

    public function updateKategori($id, $nama_kategori) {
        $query = "UPDATE kategori SET nama_kategori = :nama_kategori WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama_kategori', $nama_kategori);
        return $stmt->execute();
    }

    public function hapusKategori($id) {
        $query = "DELETE FROM kategori WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
} 