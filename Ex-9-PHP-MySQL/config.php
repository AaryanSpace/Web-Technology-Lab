<?php
define('DB_HOST', 'sql312.infinityfree.com');
define('DB_USER', 'if0_41699781');
define('DB_PASSWORD', 'WG31DY2ttM'); // Yahan apna asli password dalo
define('DB_NAME', 'if0_41699781_pahirango_shop');

$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check if connection was successful
if ($connection->connect_error) {
    // Log error for debugging
    error_log('Database connection failed: ' . $connection->connect_error);
    
    // Display user-friendly error message
    die(json_encode([
        'success' => false,
        'message' => 'Database connection failed. Please try again later.'
    ]));
}

// Set character set to UTF-8 for proper text encoding
// UTF-8mb4 supports emoji and special characters
$connection->set_charset('utf8mb4');

// Set timezone for consistent timestamps
date_default_timezone_set('UTC');

// ═══════════════════════════════════════════════════════════════
// HELPER FUNCTION: ESCAPE/SANITIZE STRINGS
// ═══════════════════════════════════════════════════════════════

/**
 * Safely escape user input for database queries
 * DEPRECATED: Use prepared statements instead (shown in api.php)
 */
function escapeInput($input) {
    global $connection;
    return $connection->real_escape_string(trim($input));
}

// Return connection object for use in other files
?>
