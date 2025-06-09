<?php
class Router {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        try {
            $url = $this->parseUrl();
            
            // Controller
            if(isset($url[0])) {
                if(file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
                    $this->controller = ucfirst($url[0]) . 'Controller';
                    unset($url[0]);
                }
            }

            // Load default controller jika tidak ada URL
            if(!file_exists('../app/controllers/' . $this->controller . '.php')) {
                throw new Exception('Controller tidak ditemukan');
            }

            require_once '../app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;

            // Method
            if(isset($url[1])) {
                if(method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }

            // Parameters
            $this->params = $url ? array_values($url) : [];

            // Call the method with parameters
            call_user_func_array([$this->controller, $this->method], $this->params);
        } catch (Exception $e) {
            // Tampilkan error
            echo '<h1>Error</h1>';
            echo '<p>' . $e->getMessage() . '</p>';
            echo '<p>File: ' . $e->getFile() . '</p>';
            echo '<p>Line: ' . $e->getLine() . '</p>';
        }
    }

    public function parseUrl() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
} 