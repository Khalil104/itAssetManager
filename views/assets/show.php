<?php
/** @var array $asset */
/** @var string $qrCodeUri */
include __DIR__ . '/../layout/header.php';
?>

<style>
/* Styles d'impression: n'affiche que l'étiquette QR Code à l'impression */
@media print {
    body * {
        visibility: hidden;
    }
    #printable-badge, #printable-badge * {
        visibility: visible;
    }
    #printable-badge {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        border: 2px dashed #000;
        padding: 20px;
        text-align: center;
    }
    .no-print {
        display: none !important;
    }
}
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <?php if (isset($_SESSION['user'])): ?>
            <a href="index.php?action=assets" class="btn btn-secondary">&larr; Retour à l'inventaire</a>
        <?php else: ?>
            <span></span> <!-- Espaceur si non connecté -->
        <?php endif; ?>

        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Imprimer l'étiquette QR Code
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Détails du Matériel #<?= htmlspecialchars($asset['id']) ?></h5>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?action=edit-asset&id=<?= $asset['id'] ?>" class="btn btn-sm btn-warning no-print">✏️ Modifier</a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Informations matériel -->
                <div class="col-md-7">
                    <table class="table table-striped">
                        <tr>
                            <th>Marque :</th>
                            <td><?= htmlspecialchars($asset['brand']) ?></td>
                        </tr>
                        <tr>
                            <th>Modèle :</th>
                            <td><?= htmlspecialchars($asset['model']) ?></td>
                        </tr>
                        <tr>
                            <th>Numéro de série :</th>
                            <td><code><?= htmlspecialchars($asset['serial_number']) ?></code></td>
                        </tr>
                        <tr>
                            <th>Assigné à :</th>
                            <td><?= htmlspecialchars($asset['assigned_user'] ?? 'Non assigné') ?></td>
                        </tr>
                        <tr>
                            <th>Date d'achat :</th>
                            <td><?= htmlspecialchars($asset['purchase_date'] ?? 'Non renseignée') ?></td>
                        </tr>
                        <tr>
                            <th>Statut :</th>
                            <td>
                                <span class="badge bg-<?= $asset['status'] === 'En service' ? 'success' : ($asset['status'] === 'En stock' ? 'primary' : 'danger') ?>">
                                    <?= htmlspecialchars($asset['status']) ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Badge QR Code imprimable -->
                <div class="col-md-5 text-center d-flex flex-column align-items-center justify-content-center">
                    <div id="printable-badge" class="border p-3 rounded bg-light">
                        <h6 class="fw-bold mb-1">IT ASSET BADGE</h6>
                        <img src="<?= $qrCodeUri ?>" alt="QR Code" class="img-fluid my-2">
                        <p class="mb-0 small fw-bold"><?= htmlspecialchars($asset['brand'] . ' ' . $asset['model']) ?></p>
                        <p class="mb-0 text-muted small">S/N: <?= htmlspecialchars($asset['serial_number']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>