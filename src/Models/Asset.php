<?php

namespace App\Models;

use Config\Database;
use PDO;

class Asset
{
    /**
     * -@- Récupérer tous les équipements
     */
    public static function getAll(): array
    {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM assets ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    /**
     * -@- Récupérer un équipement par son ID
     */
    public static function findById(int $id): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM assets WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $asset = $stmt->fetch();
        return $asset ?: null;
    }

    /**
     * -@- Créer un nouvel équipement
     */
    public static function create(array $data): bool
    {
        $db = Database::getInstance();
        $sql = "INSERT INTO assets (brand, model, serial_number, assigned_user, purchase_date, status)
                VALUES (:brand, :model, :serial_number, :assigned_user, :purchase_date, :status)";
    
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        'brand'         => $data['brand'],
        'model'         => $data['model'],
        'assigned_user' => $data['assigned_user'],
        'serial_number' => $data['serial_number'],
        'purchase_date' => !empty($data['purchase_date']) ? $data['purchase_date']  :null,
        'status'        => $data['status']
    ]);
    }

    /**
     * -@- Mettre à jour un équipement
     */
    public static function update(int $id, array $data): bool
    {
        $db = Database::getInstance();
        $sql = "UPDATE assets
                SET brand = :brand, model =  :model, serial_number = :serial_number,
                    assigned_user = :assigned_user, purchase_date = :purchase_date, status = :status
                WHERE id = :id";

        $stmt = $db->prepare($sql);

        return $stmt->execute ([
            'id'            => $id,
            'brand'         => $data['brand'],
            'model'         => $data['model'],
            'serial_number' => $data['serial_number'],
            'assigned_user' => $data['assigned_user'],
            'purchase_date' => $data['purchase_date'],
            'status'        => $data['status']
        ]);
    }

    /**
     * -@- Supprimer un équipement
     */
    public static function delete(int $id): bool
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM assets WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}