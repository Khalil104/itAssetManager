<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Ajouter un matériel</h4>
            </div>
            <div class="card-body">
                <form action="index.php?action=store-asset" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Marque</label>
                            <input type="text" name="brand" class="form-control" placeholder="ex:Dell, HP" required>  
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Modèle</label>
                            <input type="text" name="model" class="form-control" placeholder="ex: Latitude 5520" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Numéro de Série</label>
                            <input type="text" name="serial_number" class="form-control" placeholder="ex: SN-987654321" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Utilisateur assigné</label>
                            <input type="text" name="assigned_user" class="form-control" placeholder="ex: Abdoul Rachid">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form_label">Date d'achat</label>
                            <input type="date" name="purchase_date" class="form_control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Statut</label>
                            <select name="status" class="form-select">
                                <option value="En stock">En stock</option>
                                <option value="En service">En service</option>
                                <option value="En réparation">En réparation</option>
                                <option value="Rebut">Rebut</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?action=assets" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success">Enregistrer le matériel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
