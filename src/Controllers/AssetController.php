<?php

namespace App\Controllers;

use App\Models\Asset;

class AssetController
{
    /**
     * -@- Afficher la liste de tous les équipements
     */
    public function index(): void
    {
        $assets = Asset::getAll();
        require_once __DIR__ . '/../../views/assets/index.php';   
    }

    /**
     * -@- Afficher le formulaire de création
     */
    public function create(): void
    {
        require_once __DIR__ . '/../../views/assets/create.php';
    }

    /**
     * -@- Traiter la soumission du formulaire de création
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // -@-Sécurisation basique XSS
            $data = [
                'brand'         => trim(htmlspecialchars($_POST['brand'] ?? '')),
                'model'         => trim(htmlspecialchars($_POST['model'] ?? '')),
                'serial_number' => trim(htmlspecialchars($_POST['serial_number'] ?? '')),
                'assigned_user' => trim(htmlspecialchars($_POST['assigned_user'] ?? '')),
                'purchase_date' => $_POST['purchase_date'] ?? null, 
                'status'        => $_POST['status'] ?? 'En stock',
            ];

            Asset::create($data);
            header('Location: index.php?action=assets');
            exit;
        }
    }

    /**
     * -@- Afficher le formulaire d'édition
     */
    public function edit(int $id): void
    {
        $asset = Asset::findById($id);
        if (!$asset) {
            header('Location: index.php?action=assets');
            exit;
        }
        require_once __DIR__ . '/../../views/assets/edit.php';
    }

    /**
     * -@- Traiter la mise à jour d'un équipement
     */
    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'brand'         => trim(htmlspecialchars($_POST['brand'] ?? '')),
                'model'         => trim(htmlspecialchars($_POST['model'] ?? '')),
                'serial_number' => trim(htmlspecialchars($_POST['serial_number'] ?? '')),
                'assigned_user' => trim(htmlspecialchars($_POST['assigned_user'] ?? '')),
                'purchase_date' => $_POST['purchase_date'] ?? null,
                'status'        => $_POST['status'] ?? 'En stock',
            ];

            Asset::update($id, $data);
            header('Location: index.php?action=assets');
            exit;
        }
    }

    /**
     * -@- Supprimer un équipement
     */
    public function delete(int $id): void
    {
        Asset::delete($id);
        header('Location: index.php?action=assets');
        exit;
    }
}