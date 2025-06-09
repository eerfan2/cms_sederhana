<?php
// Start session
session_start();

// Load Config
require_once '../app/config/config.php';
require_once '../app/config/Database.php';

// Load Core
require_once '../core/Controller.php';
require_once '../core/Router.php';

// Initialize Router
$router = new Router(); 