<?php

namespace App\Controllers;

use App\Models\Asset;

class DashboardController
{
    public function index(): void
    {
        $totalAssets = Asset::getTotalCount();
        $statsStatus = Asset::getStatsByStatus();
        $statsBrand = Asset::getStatsByBrand();

        // Préparation des données au format JSON pour Chart.js
        $statusLabels   = array_column($statsStatus, 'status');
        $statusData     = array_column($statsStatus, 'count');

        $brandLabels    = array_column($statsBrand, 'brand');
        $brandData      = array_column($statsBrand, 'count');

        require_once __DIR__ . '/../../views/dashboard.php';
    }
}