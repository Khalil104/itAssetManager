<?php

namespace App;

use App\Controllers\AssetController;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;

class Router
{
   private array $routes = [];

   public function __construct()
   {
        $this->routes = [
            // Routes publiques
            'login'         => [AuthController::class, 'showLogin'],
            'login-submit'  => [AuthController::class, 'login'],
            'show-asset'    => [AssetController::class, 'show'],

            // Routes Protégés (connexion requise)
            'logout'        => [AuthController::class, 'logout'],
            'dashboard'     => [DashboardController::class, 'index'],
            'assets'        => [AssetController::class, 'index'],
            'create-asset'  => [AssetController::class, 'create'],
            'store-asset'   => [AssetController::class, 'store'],
            'edit-asset'    => [AssetController::class, 'edit'],
            'update-asset'  => [AssetController::class, 'update'],
            'delete-asset'  => [AssetController::class, 'delete']
        ];
   }

   public function dispatch(string $action): void
   {
    $publicRoutes = ['login', 'login-submit', 'show-asset'];

    if (!in_array($action, $publicRoutes) && !isset($_SESSION['user'])) {
        header(('Location:index.php?action=login'));
        exit;
    }

    if (array_key_exists($action, $this->routes)) {
        [$controllerClass, $method] = $this->routes[$action];
        $controller = new $controllerClass();
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id !== false && $id !== null) {
            $controller->$method($id);
        } else {
            $controller->$method();
        }
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 — Page non trouvée</h1>";
    }
   }
}