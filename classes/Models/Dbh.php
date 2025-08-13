<?php
namespace Models;

class Dbh {
    protected $pdo;

    public function __construct() {
        try {
            $dsn = 'mysql:host=localhost;dbname=farm-management;charset=utf8mb4';
            $username = 'root';
            $password = '';
            $this->pdo = new \PDO($dsn, $username, $password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (\PDOException $e) {
            // Handle connection error (log in production, don't expose details)
            throw new \PDOException('Database connection failed: ' . $e->getMessage());
        }
    }

    protected function con() {
        return $this->pdo;
    }
}