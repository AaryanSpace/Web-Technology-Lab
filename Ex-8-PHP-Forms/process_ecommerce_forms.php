<?php
/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 8: PHP FORM HANDLING & VALIDATION
 * E-COMMERCE LOGIN & REGISTRATION FORM PROCESSOR
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * Handles user authentication forms for e-commerce platform:
 * - User registration with validation
 * - User login authentication
 * - Input sanitization and security hardening
 */

// Enable CORS and set JSON header
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=utf-8');

// Initialize response
$response = [
    'success' => false,
    'errors' => [],
    'message' => '',
    'formType' => ''
];

/**
 * sanitizeInput($input)
 * 
 * Prevents XSS (Cross-Site Scripting) attacks
 * and SQL injection attempts
 */
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

/**
 * validateEmail($email)
 * 
 * Uses PHP's built-in email validation
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * validatePhone($phone)
 * 
 * Validates 10-digit phone number
 */
function validatePhone($phone) {
    return preg_match('/^[0-9]{10}$/', $phone) === 1;
}

/**
 * Validates password strength
 * Requires: 8+ chars, 1 uppercase, 1 lowercase, 1 digit
 */
function validatePassword($password) {
    return strlen($password) >= 8 && 
           preg_match('/[A-Z]/', $password) &&
           preg_match('/[a-z]/', $password) &&
           preg_match('/[0-9]/', $password);
}

// ═══════════════════════════════════════════════════════════════
// FORM PROCESSING BASED ON FORM TYPE
// ═══════════════════════════════════════════════════════════════

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $formType = isset($_POST['formType']) ? sanitizeInput($_POST['formType']) : '';
    $response['formType'] = $formType;
    
    switch ($formType) {
        
        // ─────────────────────────────────────────────────────
        // LOGIN FORM
        // ─────────────────────────────────────────────────────
        case 'login':
            $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            
            if (empty($email)) {
                $response['errors']['email'] = 'Email is required';
            } elseif (!validateEmail($email)) {
                $response['errors']['email'] = 'Invalid email address';
            }
            
            if (empty($password)) {
                $response['errors']['password'] = 'Password is required';
            }
            
            if (empty($response['errors'])) {
                // In production, verify against database
                // For demo: accept valid email/password
                $response['success'] = true;
                $response['message'] = 'Login successful!';
                // In Ex-10, this will set $_SESSION
            }
            break;
        
        // ─────────────────────────────────────────────────────
        // REGISTRATION FORM
        // ─────────────────────────────────────────────────────
        case 'register':
            $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
            $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
            
            if (empty($name)) {
                $response['errors']['name'] = 'Full name is required';
            } elseif (strlen($name) < 3) {
                $response['errors']['name'] = 'Name must be at least 3 characters';
            }
            
            if (empty($email)) {
                $response['errors']['email'] = 'Email is required';
            } elseif (!validateEmail($email)) {
                $response['errors']['email'] = 'Invalid email address';
            }
            
            if (empty($password)) {
                $response['errors']['password'] = 'Password is required';
            } elseif (!validatePassword($password)) {
                $response['errors']['password'] = 'Password must have 8+ chars, 1 uppercase, 1 lowercase, 1 digit';
            }
            
            if ($password !== $confirmPassword) {
                $response['errors']['confirmPassword'] = 'Passwords do not match';
            }
            
            if (empty($response['errors'])) {
                // In production, save to database with hashed password
                // password_hash($password, PASSWORD_DEFAULT)
                $response['success'] = true;
                $response['message'] = 'Registration successful! You can now login.';
            }
            break;
        
        default:
            $response['errors']['form'] = 'Unknown form type';
    }
    
} else {
    $response['errors']['form'] = 'Invalid request method';
}

// Send JSON response back to client
echo json_encode($response);
?>