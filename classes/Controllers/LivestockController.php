<?php
namespace Controllers;

use Models\LivestockModel;

class LivestockController {
    private $livestockModel;

    public function __construct() {
        $this->livestockModel = new LivestockModel();
    }

    public function index($livestockID, $companyID) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Unauthorized access.'];
            header("Location: ./sign-in");
            exit;
        }

        $batches = $this->livestockModel->getBatchesByLivestockID($livestockID, $companyID);
        // Pass the $batches to the view
        include __DIR__ . '/../../public/livestock.php';
    }

    public function add($livestockData) {
        $companyID = $_SESSION['user']['companyID'] ?? null;
        $userID = $_SESSION['user']['id'] ?? null;

        if ($this->livestockModel->addLivestock($livestockData, $companyID, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Livestock (' . strtoupper($livestockData['livestockName'][0]) . substr($livestockData['livestockName'], 1) . ') added successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to add livestock.'];
        }
        header("Location: /dashboard");

    }


    public function deleteLivestock($id) {
        $companyID = $_SESSION['user']['companyID'] ?? null;
        $userID = $_SESSION['user']['id'] ?? null;

        if ($this->livestockModel->deleteLivestock($id, $companyID, $userID)) {
            $_SESSION['message'] = ['type' => 's', 'text' => 'Livestock deleted successfully.'];
        } else {
            $_SESSION['message'] = ['type' => 'd', 'text' => 'Failed to delete livestock.'];
        }
        header("Location: /dashboard");

    }

}
