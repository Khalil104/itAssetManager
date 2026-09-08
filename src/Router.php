<?php

namespace App;

use App\Controllers\AssetController;
use App\Controllers\DashboardController;

class Router
{
    public function dispatch(): void
    {
        $action = $_GET['action'] ?? 'assets';
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        $assetController = new AssetController();

        switch ($action) {
            case 'assets':
                $assetController->index();
                break;

            case 'create-asset':
                $assetController->create();
                break;

            case 'store-asset':
                $assetController->store();
                break;

            case 'show-asset':
                if ($id) {
                    $assetController->show($id);
                } else {
                    header('Location: index.php?action=assets');
                }
                break;

            case 'edit-asset':
                if ($id) {
                    $assetController->edit($id);
                } else {
                    header('Location: index.php?action=assets');
                }
                break;

            case 'update-asset':
                if ($id) {
                    $assetController->update($id);
                } else {
                    header('Location: index.php?action=assets');
                }
                break;

            case 'delete-asset':
                if ($id) {
                    $assetController->delete($id);
                } else {
                    header('Location: index.php?action=assets');
                }
                break;

            // case 'dashboard':
            //     $dashboardController = new DashboardController();
            //     $dashboardController->index();
            //     break;

            default:
                http_response_code(404);
                echo "<h1 style='text-align:center; margin-top:50px;'>404 — Page non trouvée</h1>";
                break;
        }
    }
}