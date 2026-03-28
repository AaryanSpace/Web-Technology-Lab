<?php
/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 10: PHP SESSIONS & COOKIES MANAGEMENT
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * Demonstrates how to store and retrieve user information
 * across multiple pages using Sessions and Cookies
 * 
 * CONCEPTS:
 * 1. $_SESSION global array for user data
 * 2. session_start() initialization
 * 3. setcookie() function
 * 4. User authentication
 * 5. Session cleanup and destruction
 */

// MUST be called before ANY output is sent to browser
// session_start() enables the use of $_SESSION array
session_start();

header('Content-Type: application/json');

/**
 * Login Handler
 * 
 * Simulates user login by storing user data in session
 * In production, verify credentials against database
 */
function handleLogin($email, $password) {
    // Simulate database lookup (in real app, query database)
    $validUsers = [
        'user@pahirango.com' => password_hash('Pass@123', PASSWORD_BCRYPT),
        'customer@example.com' => password_hash('Demo@123', PASSWORD_BCRYPT)
    ];
    
    // Check if user exists
    if (!isset($validUsers[$email])) {
        return ['success' => false, 'message' => 'User not found'];
    }
    
    // Verify password
    if (!password_verify($password, $validUsers[$email])) {
        return ['success' => false, 'message' => 'Invalid password'];
    }
    
    // Create session data (stored on server)
    $_SESSION['userId'] = 'USER_' . uniqid();
    $_SESSION['email'] = $email;
    $_SESSION['loginTime'] = time();
    $_SESSION['lastActivity'] = time();
    
    // Optional: Create persistent cookie (stored on client browser)
    // setcookie(name, value, expire_time, path, domain, secure, httponly)
    // 86400 seconds = 1 day
    setcookie(
        'rememberMe',           // Cookie name
        $email,                 // Cookie value
        time() + (86400 * 30),  // Expires in 30 days
        '/',                    // Path (accessible from all pages)
        '',                     // Domain
        false,                  // Not HTTPS only
        true                    // HTTP only (can't be accessed by JavaScript, more secure)
    );
    
    return [
        'success' => true,
        'message' => 'Login successful!',
        'sessionId' => session_id()
    ];
}

/**
 * Logout Handler
 * 
 * Destroys session and clears cookies
 */
function handleLogout() {
    // Unset all session variables
    $_SESSION = array();
    
    // Delete specific session cookie
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,  // Past time to delete
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
    
    // Destroy the session
    session_destroy();
    
    // Delete custom cookies
    setcookie('rememberMe', '', time() - 3600, '/');
    
    return ['success' => true, 'message' => 'Logged out successfully'];
}

/**
 * Get Session Info
 * 
 * Returns current user session information
 */
function getSessionInfo() {
    if (!isset($_SESSION['userId'])) {
        return [
            'authenticated' => false,
            'message' => 'No active session'
        ];
    }
    
    // Check session timeout (30 minutes)
    $timeout = 1800;
    if (time() - $_SESSION['lastActivity'] > $timeout) {
        handleLogout();
        return [
            'authenticated' => false,
            'message' => 'Session expired due to inactivity'
        ];
    }
    
    // Update last activity time
    $_SESSION['lastActivity'] = time();
    
    return [
        'authenticated' => true,
        'userId' => $_SESSION['userId'],
        'email' => $_SESSION['email'],
        'loginTime' => $_SESSION['loginTime'],
        'sessionId' => session_id()
    ];
}

/**
 * Store User Preference
 * 
 * Stores preferences that persist across pages
 */
function storePreference($key, $value) {
    if (!isset($_SESSION['preferences'])) {
        $_SESSION['preferences'] = [];
    }
    
    $_SESSION['preferences'][$key] = $value;
    
    return ['success'=> true, 'message' => "Preference '$key' stored"];
}

/**
 * Get User Preferences
 * 
 * Retrieves user preferences from session
 */
function getPreferences() {
    if (!isset($_SESSION['preferences'])) {
        return ['preferences' => []];
    }
    
    return ['preferences' => $_SESSION['preferences']];
}

/**
 * Store Shopping Cart in Session
 * 
 * Persists cart data for multiple pages
 */
function storeCartItem($productId, $quantity) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if item already in cart
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = [
            'productId' => $productId,
            'quantity' => $quantity,
            'addedAt' => time()
        ];
    }
    
    return [
        'success' => true,
        'cartItems' => count($_SESSION['cart']),
        'cart' => $_SESSION['cart']
    ];
}

/**
 * Get Shopping Cart
 */
function getCart() {
    if (!isset($_SESSION['cart'])) {
        return ['cart' => [], 'totalItems' => 0];
    }
    
    $totalItems = array_reduce(
        $_SESSION['cart'],
        function($sum, $item) {
            return $sum + $item['quantity'];
        },
        0
    );
    
    return [
        'cart' => $_SESSION['cart'],
        'totalItems' => $totalItems
    ];
}

/**
 * Clear Shopping Cart
 */
function clearCart() {
    $_SESSION['cart'] = [];
    return ['success' => true, 'message' => 'Cart cleared'];
}

// ═══════════════════════════════════════════════════════════════
// REQUEST ROUTING
// ═══════════════════════════════════════════════════════════════

$response = ['success' => false, 'message' => ''];
$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

switch ($action) {
    case 'login':
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $response = handleLogin($email, $password);
        break;
    
    case 'logout':
        $response = handleLogout();
        break;
    
    case 'getSession':
        $response = getSessionInfo();
        break;
    
    case 'storePreference':
        $key = isset($_POST['key']) ? $_POST['key'] : '';
        $value = isset($_POST['value']) ? $_POST['value'] : '';
        $response = storePreference($key, $value);
        break;
    
    case 'getPreferences':
        $response = getPreferences();
        break;
    
    case 'addToCart':
        $productId = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        $response = storeCartItem($productId, $quantity);
        break;
    
    case 'getCart':
        $response = getCart();
        break;
    
    case 'clearCart':
        $response = clearCart();
        break;
    
    default:
        $response = ['success' => false, 'message' => 'Invalid action'];
}

echo json_encode($response);
?>