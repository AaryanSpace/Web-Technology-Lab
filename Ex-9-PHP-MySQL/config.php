<?php
/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 9: PHP & MySQL DATABASE MANAGEMENT
 * DATABASE CONNECTION & CONFIGURATION
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * Configure database connection for product management system
 * 
 * CONCEPTS:
 * 1. MySQLi connection
 * 2. Error handling
 * 3. Connection pooling concepts
 * 4. SQL database basics
 */

// Database configuration constants
define('DB_HOST', 'localhost');      // Database server address
define('DB_USER', 'root');            // Database username
define('DB_PASSWORD', '');            // Database password (empty for localhost)
define('DB_NAME', 'pahirango_shop');  // Database name

// Create database connection using MySQLi
// MySQLi = MySQL Improved, supports both object-oriented and procedural approaches

$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check if connection was successful
if ($connection->connect_error) {
    // If connection fails, display error message
    die('Connection failed: ' . $connection->connect_error);
}

// Set character set to UTF-8 for proper text encoding
$connection->set_charset('utf8mb4');

// Return connection object for use in other files
?>