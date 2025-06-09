<?php
class KategoriController extends Controller {
    private $kategoriModel;

    public function __construct() {
        $this->kategoriModel = $this->model('Kategori');
    }

    public function index() {
        $data['kategori'] = $this->kategoriModel->getAllKategori();
        $this->view('kategori/index', $data);
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_kategori = $_POST['nama_kategori'];
            
            if ($this->kategoriModel->tambahKategori($nama_kategori)) {
                header('Location: ' . BASEURL . '/kategori');
                exit;
            }
        }
        $this->view('kategori/tambah');
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_kategori = $_POST['nama_kategori'];
            
            if ($this->kategoriModel->updateKategori($id, $nama_kategori)) {
                header('Location: ' . BASEURL . '/kategori');
                exit;
            }
        }

        $data['kategori'] = $this->kategoriModel->getKategoriById($id);
        $this->view('kategori/edit', $data);
    }

    public function hapus($id) {
        if ($this->kategoriModel->hapusKategori($id)) {
            header('Location: ' . BASEURL . '/kategori');
            exit;
        }
    }
} 