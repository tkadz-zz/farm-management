<?php
namespace Controllers;

use Models\AuthModel;

class AuthController {
    private $authModel;

    public function __construct() {
        $this->authModel = new AuthModel();
    }

    public function signin($loginID, $password) {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($this->authModel->authenticate($loginID, $password)) {
                // Success: Set session and redirect
                $_SESSION['message'] = ['type' => 's', 'text' => 'Login successful!'];
                header('Location: /dashboard'); // Redirect to success page
                exit;
            } else {
                // Failure: Log error and store error message
                $errorMessage = 'Invalid credentials for LoginID: ' . htmlspecialchars($loginID);
                error_log($errorMessage, 3, __DIR__ . '/../../logs/auth_errors.log');
                $_SESSION['message'] = ['type' => 'w', 'text' => 'Invalid Login ID or password.'];
                header('Location: /sign-in?loginID=' . urlencode($loginID)); // Redirect back to signin page
                exit;
            }
        } else {
            header('Location: /sign-in');
            exit;
        }
    }
}