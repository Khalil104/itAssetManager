<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AssetController;

$action = $_GET['action'] ?? 'assets';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$controller = new AssetController();

switch ($action) {
    case 'assets':
        $controller->index();
        break;
    case 'create-asset':
        $controller->create();
        break;
    case 'store-asset':
        $controller->store();
        break;
    case 'edit-asset':
        if ($id) {
            $controller->edit($id);
        } else {
            header('Location: index.php?action=assets');
        }
        break;
    case 'update-asset':
        if ($id) {
            $controller->update($id);
        } else {
            header('Location: index.php?action=assets');
        }
        break;
    case 'delete-asset':
        if ($id) {
            $controller->delete($id);
        } else {
            header('Location: index.php?action=assets');
        }
        break;
    default:
        http_response_code(404);
        echo "<h1style='text-align:center; margin-top:50px;'>404 — Page non trouvée</h1>";
}
