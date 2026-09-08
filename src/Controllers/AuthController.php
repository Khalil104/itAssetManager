<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function showLogin(): void
    {
        if(isset($_SESSION['user'])) {
            header('Location: index.php?action=dashboard');
            exit;
        }
        require_once __DIR__ . '/../../views/auth/login.php';
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $user = User::verifyCredentials($username, $password);

            if ($user) {$_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username']
                ];
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                $error = "Identifiants incorrects";
                require_once __DIR__ . '/../../views/auth/login.php';
            }
        }
    }

    public function logout(): void{
        unset($_SESSION['user']);
        session_destroy();
        header('Location:index.php?action=login');
        exit;
    }
}