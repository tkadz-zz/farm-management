<?php
require_once __DIR__ . '/../autoloader/autoloader.php';

use Controllers\AuthController;
use Controllers\BatchController;
use Controllers\DashboardController;

session_start();

$url = $_GET['url'] ?? '';

switch (true) {
    case $url === 'auth-sign-in':
        $controller = new AuthController();
        $controller->signin($_POST['loginID'] ?? '', $_POST['password'] ?? '');
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
    case $url === 'dashboard/index':
        $controller = new DashboardController();
        $controller->index();
        break;
    default:
        http_response_code(404);
        echo "Page not found";
        break;
}