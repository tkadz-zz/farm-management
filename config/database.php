<?php
// config/database.php
return [
    'host' => 'localhost',
    'database' => 'my_app',
    'username' => 'root',
    'password' => '',
];

class Database {
    private static $instance = null;
    public $conn;

    private function __construct() {
        $config = require __DIR__ . '/database.php';
        $this->conn = new PDO(
            "mysql:host={$config['host']};dbname={$config['database']}",
            $config['username'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }
}