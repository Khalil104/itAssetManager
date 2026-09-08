<?php

namespace App\Controllers;

use App\Models\Asset;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

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

    /**
     * -@- Afficher le code QR Code du matériel
     */
    public function show(int $id): void
    {
        $asset = Asset::findById($id);

        if (!$asset) {
            header('Location: index.php?action=assets');
            exit;
        }

        // -@- Contenu à encoder dans le QR Code (ex: URL verss la fiche ou identifiant unique.)
        // $qrData = "ASSET-ID: {$asset['id']} | Serial: {$asset['serial_number']} | Model: {$asset['model']}";
        
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $qrData = "{$protocol}://{$host}/itAssetManager/public/index.php?action=show-asset&id={$asset['id']}";

        // -@- Génération du QR Code via Endroid QR Code
        $writer =  new PngWriter;
        $qrCode = new QrCode(
            data: $qrData,
            size: 200,
            margin: 10
        );

        $result = $writer->write($qrCode);

        // Conversion en Data URI pour l'injecter directement dans la balise <img>
        $qrCodeUri = $result->getDataUri();

        // Ingestion de la vue 
        require_once __DIR__ . '/../../views/assets/show.php';
    }
}