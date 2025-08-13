<?php
namespace Models;

class AuthModel extends Dbh {

    public function authenticate($loginID, $password) {
        try {
            $stmt = $this->con()->prepare('SELECT * FROM users WHERE loginID = :loginID');
            $stmt->execute(['loginID' => $loginID]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Start session and store user data
                session_start();
                
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'companyID' => $user['companyID'],
                    'loginID' => $user['loginID'],
                    'role' => $user['role'],
                    'status' => $user['status'],
                ];

                $userData = $this->fetchUserData($_SESSION['user']['id'], $_SESSION['user']['role']);
                
                if($userData){
                    $_SESSION['user_data'] = [
                        'name' => $userData['name'],
                        'surname' => $userData['surname'],
                        'email' => $userData['email'],
                        'phone' => $userData['phone'],
                        'address' => $userData['address'],
                    ];
                }
                

                return [
                    'user' => $_SESSION['user'] ?? null,
                    'user_data' => $_SESSION['user_data'] ?? null
                ];
                    
                
            }
            return false; // Invalid credentials
        } catch (\PDOException $e) {
            // Handle query error (log in production)
            return false;
        }
    }


    public function fetchUserData($userID, $role) {
        try {
            // Sanitize role to prevent SQL injection (safe because it's table name only)
            $tableName = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '', $role));
    
            // Check if table exists (no binding here — SHOW TABLES LIKE doesn't work with placeholders)
            $stmt = $this->con()->query("SHOW TABLES LIKE '$tableName'");
            if ($stmt->rowCount() === 0) {
                error_log("Table '$tableName' does not exist for userID: $userID", 3, __DIR__ . '/../../logs/auth_errors.log');
                return false;
            }
    
            // Fetch data from role-specific table using userID
            $stmt = $this->con()->prepare("SELECT * FROM `$tableName` WHERE userID = :userID");
            $stmt->execute(['userID' => $userID]);
            $userData = $stmt->fetch();
    
            if ($userData) {
                return $userData; // Return role-specific data
            }
    
            error_log("No data found in table '$tableName' for userID: $userID", 3, __DIR__ . '/../../logs/auth_errors.log');
            return false;
        } catch (\PDOException $e) {
            error_log('Database error in fetchUserData: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/auth_errors.log');
            return false;
        }
    }
    

}