<?php include __DIR__ . '/../layout/header.php'; ?>
<?php /** @var array $asset */ ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Modifier l'équipement #<?= $asset['id'] ?></h4>
            </div>
            <div class="card-body">
                <form action="index.php?action=update-asset&id=<?= $asset['id'] ?>" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Marque</label>
                            <input type="text" name="brand" class="form-control" value="<?= htmlspecialchars($asset['brand']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Modèle</label>
                            <input type="text" name="model" class="form-control" value="<?= htmlspecialchars($asset['model']) ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Numéro de Série</label>
                            <input type="text" name="serial_number" class="form-control" value="<?= htmlspecialchars($asset['serial_number']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Utilisateur assigné</label>
                            <input type="text" name="assigned_user" class="form-control" value="<?= htmlspecialchars($asset['assigned_user']) ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Date d'achat</label>
                            <input type="date" name="purchase_date" class="form-control" value="<?= $asset['purchase_date'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Statut</label>
                            <select name="status" class="form-select">
                                <option value="En stock" <?= $asset['status'] === 'En stock' ? 'selected' : '' ?>>En stock</option>
                                <option value="En service" <?= $asset['status'] === 'En service' ? 'selected' : '' ?>>En service</option>
                                <option value="En réparation" <?= $asset['status'] === 'En réparation' ? 'selected' : '' ?>>En réparation</option>
                                <option value="Rebut" <?= $asset['status'] === 'Rebut' ? 'selected' : '' ?>>Rebut</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?action=assets" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-warning">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>