<?php
namespace Controllers;

use Models\ProfileModel;

class ProfileController {
    private $profileModel;

    public function __construct() {
        $this->profileModel = new ProfileModel();
    }

    public function index($userID, $role) {

        $userProfile = $this->profileModel->getUserProfile($userID, $role);

        include __DIR__ . '/../../public/profile.php';
    }

    
}

