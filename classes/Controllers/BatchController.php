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


    public function addBatch($batchData) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $companyID = $_SESSION['user']['companyID'] ?? null;
        $userID = $_SESSION['user']['id'] ?? null;

        // Validate and process $batchData
        if ($this->batchModel->addBatch($batchData, $companyID, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Batch added successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to add batch.'];
        }

        header("Location: /dashboard");
        exit;
    }

    public function addSale($batchData){
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        // Validate and process $batchData
        if ($this->batchModel->addSale($batchData, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Sale added successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to add sale.'];
        }

        header("Location: /batch/" . $batchData['batchID']);
        exit;
    }

    
    public function addLoss($data){
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        // Validate and process $batchData
        if ($this->batchModel->addLoss($data, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Loss added successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to add sale.'];
        }

        header("Location: /batch/" . $data['batchID']);
        exit;
    }


    public function addHealthRecord($data) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        // Validate and process $data
        if ($this->batchModel->addHealthRecord($data, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Health record added successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to add health record.'];
        }

        header("Location: /batch/" . $data['batchID']);
        exit;
    }

    public function addGrowthLog($data) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        // Validate and process $data
        if ($this->batchModel->addGrowthLog($data, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Growth log added successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to add growth log.'];
        }

        header("Location: /batch/" . $data['batchID']);
        exit;
    }



    public function deleteSale($id, $batchID) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        if ($this->batchModel->deleteSale($id, $batchID, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Sale deleted successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to delete sale.'];
        }

        header("Location: /batch/" . $batchID);
        exit;
    }

    public function deleteLoss($id, $batchID) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        if ($this->batchModel->deleteLoss($id, $batchID, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Loss deleted successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to delete loss.'];
        }

        header("Location: /batch/" . $batchID);
        exit;
    }

    public function deleteGrowthLog($id, $batchID) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        if ($this->batchModel->deleteGrowthLog($id, $batchID, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Growth log deleted successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to delete growth log.'];
        }

        header("Location: /batch/" . $batchID);
        exit;
    }

    public function deleteHealthRecord($id, $batchID) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $userID = $_SESSION['user']['id'] ?? null;

        if ($this->batchModel->deleteHealthRecord($id, $batchID, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Health record deleted successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to delete health record.'];
        }

        header("Location: /batch/" . $batchID);
        exit;
    }


    public function deleteBatch($batchID) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }
        
        $companyID = $_SESSION['user']['companyID'] ?? null;
        $userID = $_SESSION['user']['id'] ?? null;


        if ($this->batchModel->deleteBatch($batchID, $companyID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Batch deleted successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to delete batch.'];
        }

        header("Location: /dashboard");
        exit;
    }


    public function updateBatch($data) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $userID = $_SESSION['user']['id'] ?? null;
        $companyID = $_SESSION['user']['companyID'] ?? null;

        // Validate and process $data
        if ($this->batchModel->updateBatch($data, $userID, $companyID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Batch updated successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to update batch.'];
        }

        header("Location: /dashboard");
        exit;
    }
    


}
