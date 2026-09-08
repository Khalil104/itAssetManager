<?php
/** @var int $totalAssets */
/** @var array<int, string> $statusLabels */
/** @var array<int, int> $statusData */
/** @var array<int, string> $brandLabels */
/** @var array<int, int> $brandData */
include __DIR__ . '/layout/header.php';
?>

<!-- CDN Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
    <h2 class="mb-4">Tableau de bord statistiques</h2>
    <!-- Carte métrique Global -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total des Equipements</h5>
                    <p class="card-text display-4 fw-bold"><?= $totalAssets ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques Chart.js -->
    <div class="row">
        <!-- Graphique Répartition par Statut -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-header bg-dark text-white">
                    <h6 class="mb-0">Répartition par Statut</h6>
                </div>
                <div class="card-body">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Graphique Répartition par Marque -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-dark text-white">
                    <h6 class="mb-0">Répartition par Marque</h6>
                </div>
                <div class="card-body">
                    <canvas id="brandChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Graphique des Status (Doughnut Chart)
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($statusLabels) ?>,
            datasets: [{
                data: <?= json_encode($statusData) ?>,
                backgroundColor: ['#0d6efd', '#198754', '#dc3545', '#ffc107', '#0dcaf0']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom'}
            }
        }
    });

    // Graphique des Marques (Bar Chart)
    const ctxBrand = document.getElementById('brandChart').getContext('2d');
    new Chart(ctxBrand, {
        type: 'bar',
        data: {
            labels: <?= json_encode($brandLabels) ?>,
            datasets: [{
                label: 'Nombre d\'équipements',
                data: <?= json_encode($brandData) ?>,
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true,ticks: { precision: 0 } }
            }
        }
    });
</script>

<?php include __DIR__ . '/layout/footer.php'; ?>