<!DOCTYPE html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT-Asset Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
</head>
<style>
    body {
        font-family: 'Source Sans Pro', sans-serif;
    }
</style>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="index.php" class="navbar-brand fw-bold">IT Asset Manager</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if (isset($_SESSION['user'])): ?>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="index.php?action=assets" class="nav-link">Equipements</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=dashboard" class="nav-link">Dashboard</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center text-white gap-3">
                    <span class="small"><?= htmlspecialchars($_SESSION['user']['username']) ?></span>
                    <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm">Déconnexion</a>
                </div>
            <?php else: ?>
                <div class="ms-auto">
                    <a href="index.php?action=login" class="btn btn-outline-light btn-sm">Espace Technicien</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</body>
</html>