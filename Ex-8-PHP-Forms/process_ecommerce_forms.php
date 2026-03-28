<?php
/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 8: PHP FORM HANDLING & VALIDATION
 * E-COMMERCE CONTACT FORM PROCESSOR
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * This script handles form submissions from the e-commerce website
 * including:
 * - Customer inquiries
 * - Order status checks
 * - Product feedback
 * - Server-side validation
 * - Security hardening
 */

// Set JSON response header
header('Content-Type: application/json');

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
 * validateZipCode($zip)
 * 
 * Validates 5-6 digit postal code
 */
function validateZipCode($zip) {
    return preg_match('/^[0-9]{5,6}$/', $zip) === 1;
}

// ═══════════════════════════════════════════════════════════════
// FORM TYPE IDENTIFICATION AND PROCESSING
// ═══════════════════════════════════════════════════════════════

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form type to determine which validation to apply
    $formType = isset($_POST['formType']) ? sanitizeInput($_POST['formType']) : '';
    $response['formType'] = $formType;
    
    // PROCESS BASED ON FORM TYPE
    switch ($formType) {
        
        // ─────────────────────────────────────────────────────
        // CUSTOMER INQUIRY FORM
        // ─────────────────────────────────────────────────────
        case 'inquiry':
            $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
            $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
            $subject = isset($_POST['subject']) ? sanitizeInput($_POST['subject']) : '';
            $inquiry = isset($_POST['inquiry']) ? sanitizeInput($_POST['inquiry']) : '';
            
            // Validate inquiry form
            if (empty($name)) {
                $response['errors']['name'] = 'Name is required';
            } elseif (strlen($name) < 2) {
                $response['errors']['name'] = 'Name must be at least 2 characters';
            }
            
            if (empty($email)) {
                $response['errors']['email'] = 'Email is required';
            } elseif (!validateEmail($email)) {
                $response['errors']['email'] = 'Invalid email address';
            }
            
            if (empty($subject)) {
                $response['errors']['subject'] = 'Subject is required';
            }
            
            if (empty($inquiry)) {
                $response['errors']['inquiry'] = 'Please share your inquiry';
            } elseif (strlen($inquiry) < 10) {
                $response['errors']['inquiry'] = 'Inquiry must be at least 10 characters';
            }
            
            // If valid, process inquiry
            if (empty($response['errors'])) {
                $response['success'] = true;
                $response['message'] = 'Thank you for contacting us! We will reply within 24 hours.';
                error_log("Inquiry received from: $name ($email) - Subject: $subject");
            }
            break;
        
        // ─────────────────────────────────────────────────────
        // REGISTRATION FORM
        // ─────────────────────────────────────────────────────
        case 'registration':
            $fullName = isset($_POST['fullName']) ? sanitizeInput($_POST['fullName']) : '';
            $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
            $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
            $address = isset($_POST['address']) ? sanitizeInput($_POST['address']) : '';
            $city = isset($_POST['city']) ? sanitizeInput($_POST['city']) : '';
            $postalCode = isset($_POST['postalCode']) ? sanitizeInput($_POST['postalCode']) : '';
            
            // Validate registration form
            if (empty($fullName) || strlen($fullName) < 3) {
                $response['errors']['fullName'] = 'Valid name required';
            }
            
            if (empty($email) || !validateEmail($email)) {
                $response['errors']['email'] = 'Valid email required';
            }
            
            if (empty($phone) || !validatePhone($phone)) {
                $response['errors']['phone'] = 'Valid 10-digit phone required';
            }
            
            if (empty($password) || strlen($password) < 8) {
                $response['errors']['password'] = 'Password must be at least 8 characters';
            }
            
            if ($password !== $confirmPassword) {
                $response['errors']['confirmPassword'] = 'Passwords do not match';
            }
            
            if (empty($address) || strlen($address) < 10) {
                $response['errors']['address'] = 'Valid address required';
            }
            
            if (empty($city)) {
                $response['errors']['city'] = 'City is required';
            }
            
            if (empty($postalCode) || !validateZipCode($postalCode)) {
                $response['errors']['postalCode'] = 'Valid 5-6 digit postal code required';
            }
            
            // Process registration if valid
            if (empty($response['errors'])) {
                // Hash password for security using bcrypt
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                
                $response['success'] = true;
                $response['message'] = 'Registration successful! You can now log in.';
                
                // In production, store in database:
                // INSERT INTO users (fullName, email, phone, password, address, city, postalCode)
                // VALUES ($fullName, $email, $phone, $hashedPassword, $address, $city, $postalCode)
                
                error_log("New registration: $fullName ($email)");
            }
            break;
        
        // ─────────────────────────────────────────────────────
        // NEWSLETTER SUBSCRIPTION
        // ─────────────────────────────────────────────────────
        case 'newsletter':
            $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
            
            if (empty($email)) {
                $response['errors']['email'] = 'Email is required';
            } elseif (!validateEmail($email)) {
                $response['errors']['email'] = 'Invalid email address';
            } else {
                $response['success'] = true;
                $response['message'] = 'Successfully subscribed to our newsletter!';
                error_log("Newsletter subscription: $email");
            }
            break;
        
        default:
            $response['message'] = 'Unknown form type';
    }
    
} else {
    $response['message'] = 'Invalid request method';
}

// Send JSON response back to client
echo json_encode($response);
?>