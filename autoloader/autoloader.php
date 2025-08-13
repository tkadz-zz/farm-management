<?php
spl_autoload_register(function ($className) {
    $classPath = __DIR__ . '/../classes/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
    }
});

// --- autoloader/autoloader.php ---
