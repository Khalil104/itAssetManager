<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3 m-2">
    <h2></h2>
    <a href="index.php?action=create-asset" class="btn btn-primary">+ Ajouter un matériel</a>
</div>

<div class="card shadow-sm m-2">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>N° Série</th>
                    <th>Utilisateur</th>
                    <th>Date d'achat</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($assets)): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Aucun équipement enregistré dans l'inventaire</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($assets as $asset): ?>
                            <tr>
                                <td><?= $asset['id'] ?></td>
                                <td><strong><?= htmlspecialchars($asset['brand']) ?></strong></td>
                                <td><?= htmlspecialchars($asset['model']) ?></td>
                                <td><code><?= htmlspecialchars($asset['serial_number']) ?></code></td>
                                <td><?= htmlspecialchars($asset['assigned_user']) ?></td>
                                <td><?= $asset['purchase_date'] ? date('d/m/Y', strtotime($asset['purchase_date'])) : '-' ?></td>
                                <td>
                                    <span class="badge bg-secondary"><?= htmlspecialchars($asset['status']) ?></span>
                                </td>
                                <td class="text-end">
                                    <a href="index.php?action=show-asset&id=<?= $asset['id'] ?>" class="btn btn-sm btn-outline-info">QR Code</a>
                                    <a href="index.php?action=edit-asset&id=<?= $asset['id'] ?>" class="btn btn-sm btn-outline-primary">Editer</a>
                                    <a href="index.php?action=delete-asset&id=<?= $asset['id']?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Confirmer la suppression de cet équipement ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
