<?php
namespace Controllers;

use Models\BatchModel;

class BatchController {
    private $batchModel;

    public function __construct() {
        $this->batchModel = new BatchModel();
    }

    public function index($batchID, $companyID) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        } 
        
        $batches = $this->batchModel->getBatchesByBatchIDandCompanyID($batchID, $companyID);
        $batchSales = $this->batchModel->getBatchSalesByID($batchID);
        $batchLosses = $this->batchModel->getBatchLossesByBatchID($batchID);
        $batchGrowthLogs = $this->batchModel->getGrowthLogsByBatchID($batchID);
        $batchHealthRecords = $this->batchModel->getBatchHealthRecordsByBatchID($batchID);

        // Pass the $batches to the view
        include __DIR__ . '/../../public/batch.php';
    }


}
