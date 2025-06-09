<?php
class Artikel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllArtikel() {
        $query = "SELECT artikel.*, kategori.nama_kategori 
                 FROM artikel 
                 LEFT JOIN kategori ON artikel.kategori_id = kategori.id 
                 ORDER BY artikel.tanggal DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArtikelById($id) {
        $query = "SELECT artikel.*, kategori.nama_kategori 
                 FROM artikel 
                 LEFT JOIN kategori ON artikel.kategori_id = kategori.id 
                 WHERE artikel.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahArtikel($judul, $isi, $kategori_id, $gambar) {
        $query = "INSERT INTO artikel (judul, isi, kategori_id, gambar, tanggal) 
                 VALUES (:judul, :isi, :kategori_id, :gambar, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':isi', $isi);
        $stmt->bindParam(':kategori_id', $kategori_id);
        $stmt->bindParam(':gambar', $gambar);
        return $stmt->execute();
    }

    public function updateArtikel($id, $judul, $isi, $kategori_id, $gambar) {
        $query = "UPDATE artikel 
                 SET judul = :judul, 
                     isi = :isi, 
                     kategori_id = :kategori_id, 
                     gambar = :gambar 
                 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':isi', $isi);
        $stmt->bindParam(':kategori_id', $kategori_id);
        $stmt->bindParam(':gambar', $gambar);
        return $stmt->execute();
    }

    public function hapusArtikel($id) {
        $query = "DELETE FROM artikel WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
} 