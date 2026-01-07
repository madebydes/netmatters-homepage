<?php
/**
 * Application Initialization
 * Loads all required files and configurations
 */

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('LINK_EXT', '.php');

// Load database configuration
require_once __DIR__ . '/database.php';


// Autoload classes
spl_autoload_register(function ($class) {
    $classFile = __DIR__ . '/../classes/' . $class . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
