<?php
require_once __DIR__ . '/../autoloader/autoloader.php';

use Controllers\AuthController;
use Controllers\BatchController;
use Controllers\DashboardController;
use Controllers\ProfileController;
use Controllers\LivestockController;

session_start();

$url = $_GET['url'] ?? '';

switch (true) {
    case $url === 'auth-sign-in':
        $controller = new AuthController();
        $controller->signin($_POST['loginID'] ?? '', $_POST['password'] ?? '');
        break;


    case $url === 'profile':
        $controller = new ProfileController();
        $controller->index($_SESSION['user']['id'] ?? 0, $_SESSION['user']['role'] ?? '');
        break;
        

    case $url === 'batch':
        $batchID = isset($_GET['batch']) ? intval($_GET['batch']) : 0;
        $companyID = $_SESSION['user']['companyID'] ?? 0;

        if ($batchID > 0 && $companyID > 0) {
            $controller = new BatchController();
            $controller->index($batchID, $companyID);
        } else {
            echo "Invalid request";
        }
        break;


    case $url === 'livestock':
        $livestockID = isset($_GET['livestock']) ? intval($_GET['livestock']) : 0;
        $companyID = $_SESSION['user']['companyID'] ?? 0;

        $controller = new LivestockController();
        $controller->index($livestockID, $companyID);
        break;


    case $url === 'dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;


    case $url === 'add_batch':
        $total_cost = ($_POST['batchQuantity'] ?? 0) * ($_POST['costPerUnit'] ?? 0);
        $batchData = [
            'batchName' => $_POST['batchName'] ?? '',
            'livestockID' => $_POST['livestockID'] ?? 0,
            'quantity' => $_POST['batchQuantity'] ?? 0,
            'costPerUnit' => $_POST['costPerUnit'] ?? 0,
            'totalCost' => $total_cost,
            'purchasedFrom' => $_POST['purchasedFrom'] ?? '',
            'purchaseDate' => $_POST['purchaseDate'] ?? '',
            'status' => $_POST['status'] ?? '',
            'notes' => $_POST['notes'] ?? '',
            'expected_at' => $_POST['expected_at'] ?? '',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $controller = new BatchController();
        $controller->addBatch($batchData);
        break;


    case $url === 'add_livestock':
        $livestockData = [
            'livestockName' => $_POST['livestockName'] ?? '',
            'category' => $_POST['category'] ?? '',
        ];

        $controller = new LivestockController();
        $controller->add($livestockData);
        break;

    case $url === 'add_sale':
        $saleData = [
            'batchID' => $_POST['batchID'] ?? 0,
            'quantity' => $_POST['quantity'] ?? 0,
            'unitPrice' => $_POST['unitPrice'] ?? 0,
            'buyerName' => $_POST['buyerName'] ?? '',
            'soldOn' => $_POST['soldOn'] ?? '',
            'notes' => $_POST['notes'] ?? '',
        ];

        $controller = new BatchController();
        $controller->addSale($saleData);
        break;

    case $url === 'add_loss':
        $data = [
            'batchID' => $_POST['batchID'] ?? 0,
            'quantity' => $_POST['quantity'] ?? 0,
            'unitPrice' => $_POST['unitPrice'] ?? 0,
            'reason' => $_POST['reason'] ?? '',
            'dateIncurred' => $_POST['dateIncurred'] ?? '',
            'notes' => $_POST['notes'] ?? '',
        ];
        $controller = new BatchController();
        $controller->addLoss($data);
        break;


    case $url === 'add_health_record':
        $data = [
            'batchID' => $_POST['batchID'] ?? 0,
            'type' => $_POST['type'] ?? '',
            'estimated_costs' => $_POST['estimated_costs'] ?? 0,
            'dateRecorded' => $_POST['dateRecorded'] ?? date('Y-m-d'),
            'notes' => $_POST['notes'] ?? '',
        ];

        $controller = new BatchController();
        $controller->addHealthRecord($data);
        break;

    case $url === 'add_growth_log':
        $data = [
            'batchID' => $_POST['batchID'] ?? 0,
            'averageWeight' => $_POST['averageWeight'] ?? 0,
            'dateRecorded' => $_POST['dateRecorded'] ?? date('Y-m-d'),
            'notes' => $_POST['notes'] ?? '',
        ];

        $controller = new BatchController();
        $controller->addGrowthLog($data);
        break;

    default:
        http_response_code(404);
        echo "Page not found";
        break;
}