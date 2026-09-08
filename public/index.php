<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;

session_start();

$action = $_GET['action'] ?? (isset($_SESSION['user']) ? 'dashboard' : 'login');

$router = new Router();
$router->dispatch($action);