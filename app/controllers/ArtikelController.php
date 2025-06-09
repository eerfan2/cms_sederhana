<?php
class ArtikelController extends Controller {
    private $artikelModel;

    public function __construct() {
        $this->artikelModel = $this->model('Artikel');
    }

    public function index() {
        $data['artikel'] = $this->artikelModel->getAllArtikel();
        $this->view('artikel/index', $data);
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $id_kategori = $_POST['id_kategori'];
            
            // Handle file upload
            $gambar = '';
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
                $target_dir = "../public/images/";
                $gambar = time() . '_' . basename($_FILES["gambar"]["name"]);
                $target_file = $target_dir . $gambar;
                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
            }

            if ($this->artikelModel->tambahArtikel($judul, $isi, $id_kategori, $gambar)) {
                header('Location: ' . BASEURL . '/artikel');
                exit;
            }
        }
        $this->view('artikel/tambah');
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $id_kategori = $_POST['id_kategori'];
            
            // Handle file upload
            $gambar = $_POST['gambar_lama'];
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
                $target_dir = "../public/images/";
                $gambar = time() . '_' . basename($_FILES["gambar"]["name"]);
                $target_file = $target_dir . $gambar;
                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
            }

            if ($this->artikelModel->updateArtikel($id, $judul, $isi, $id_kategori, $gambar)) {
                header('Location: ' . BASEURL . '/artikel');
                exit;
            }
        }

        $data['artikel'] = $this->artikelModel->getArtikelById($id);
        $this->view('artikel/edit', $data);
    }

    public function hapus($id) {
        if ($this->artikelModel->hapusArtikel($id)) {
            header('Location: ' . BASEURL . '/artikel');
            exit;
        }
    }
} 