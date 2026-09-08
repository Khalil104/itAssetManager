<?php

namespace App\Models;

use Config\Database;
use PDO;

class User
{
    /**
     * Recherche un utilisateur par son nom d'utilisateur
     */
    public static function findByUsername(string $username): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Vérifie les identifiants de connexion
     */
    public static function verifyCredentials(string $username, string $password): ?array
    {
        $user = self::findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }
}