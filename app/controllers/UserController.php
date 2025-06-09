<?php
class UserController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function index() {
        $data['users'] = $this->userModel->getAllUsers();
        $this->view('user/index', $data);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $user = $this->userModel->login($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ' . BASEURL . '/dashboard');
                exit;
            } else {
                $data['error'] = 'Username atau password salah!';
                $this->view('user/login', $data);
            }
        } else {
            $this->view('user/login');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASEURL . '/user/login');
        exit;
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            
            if ($this->userModel->tambahUser($username, $password, $email)) {
                header('Location: ' . BASEURL . '/user');
                exit;
            }
        }
        $this->view('user/tambah');
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            
            if ($this->userModel->updateUser($id, $username, $email)) {
                if (!empty($_POST['password'])) {
                    $this->userModel->updatePassword($id, $_POST['password']);
                }
                header('Location: ' . BASEURL . '/user');
                exit;
            }
        }

        $data['user'] = $this->userModel->getUserById($id);
        $this->view('user/edit', $data);
    }

    public function hapus($id) {
        if ($this->userModel->hapusUser($id)) {
            header('Location: ' . BASEURL . '/user');
            exit;
        }
    }
} 