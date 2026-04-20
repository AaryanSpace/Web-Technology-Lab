<?php
// Localhost (XAMPP) Credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', ''); // XAMPP mein password blank rehta hai
define('DB_NAME', 'pahirango_db');

// Create connection
$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check if connection was successful
if ($connection->connect_error) {
    error_log('Database connection failed: ' . $connection->connect_error);
    die(json_encode([
        'success' => false,
        'message' => 'Database connection failed. Please try again later.'
    ]));
}

// Set character set to UTF-8 for proper text encoding
$connection->set_charset('utf8mb4');

// Set timezone for consistent timestamps
date_default_timezone_set('UTC');

// ═══════════════════════════════════════════════════════════════
// HELPER FUNCTION: ESCAPE/SANITIZE STRINGS
// ═══════════════════════════════════════════════════════════════

function escapeInput($input) {
    global $connection;
    return $connection->real_escape_string(trim($input));
}
?>