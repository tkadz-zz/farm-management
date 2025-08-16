<?php
namespace Controllers;

use Models\DashboardModel;

class DashboardController {
    private $dashboardModel;

    public function __construct() {
        $this->dashboardModel = new DashboardModel();
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            header("Location: ./sign-in");
            exit;
        }

        $companyID = $_SESSION['user']['companyID'] ?? null;

        if (!$companyID) {
            die("Company ID missing from session.");
        }

        // Fetch data from the model
        $batches = $this->dashboardModel->getDashboardData($companyID);
        $livestock = $this->dashboardModel->getLivestock($companyID);

        
        // Include the view with $batches and $livestock available
        include __DIR__ . '/../../public/dashboard.php';
    }

    
}

