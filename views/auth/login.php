<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Connexion Technicien IT</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form action="index.php?action=login-submit" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Utilisateur</label>
                            <input type="text" name="username" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                    </form>
                </div>
                <div class="card-footer text-muted text-center small">
                    <!-- Compte démo : <code>admin</code> / <code>admin123</code> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php' ?>