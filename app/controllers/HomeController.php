<?php
class HomeController extends Controller {
    public function __construct() {
        // Cek session
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/user/login');
            exit;
        }
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $this->view('home/index', $data);
    }
} 