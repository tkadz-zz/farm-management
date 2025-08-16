<?php
namespace Models;

class ProfileModel extends Dbh {
    
    public function getUserProfile($userID, $role) {
        
        $tableName = strtolower(preg_replace('/[^a-zA-Z0-9_]/', '', $role));
        $stmt = $this->con()->query("SHOW TABLES LIKE '$tableName'");
        if ($stmt->rowCount() === 0) {
            error_log("Table '$tableName' does not exist for userID: $userID", 3, __DIR__ . '/../../logs/auth_errors.log');
            return false;
        }

        try {
            $stmt = $this->con()->prepare("SELECT
            u.*,
            p.*
            FROM users u
            LEFT JOIN `$tableName` p ON u.id = p.userID
            WHERE u.id = :id
            ");
            $stmt->execute(['id' => $userID]);
            return $stmt->fetch();
        } catch (\PDOException $e) {
            error_log('ProfileModel getUserProfile error: ' . $e->getMessage(), 3, __DIR__ . '/../../logs/profile_errors.log');
            return false;
        }
    }

    // Additional methods for updating profile, etc. can be added here

}
