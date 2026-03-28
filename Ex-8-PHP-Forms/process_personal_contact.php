<?php
/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 8: PHP FORM HANDLING & VALIDATION
 * PERSONAL WEBSITE CONTACT FORM PROCESSOR
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * This script demonstrates:
 * - Server-side form validation in PHP
 * - Sanitizing user input to prevent security issues
 * - Processing and validating form data
 * - Sending email notifications
 * - Error handling and feedback
 * 
 * CONCEPTS COVERED:
 * 1. $_POST and $_GET superglobals
 * 2. isset() and empty() functions
 * 3. Regular expressions with preg_match()
 * 4. htmlspecialchars() for security
 * 5. mail() function for email
 * 6. Array operations for form data
 * 7. Associative arrays for validation results
 */

// Set the content type to JSON for AJAX responses
header('Content-Type: application/json');

// Initialize response array
$response = [
    'success' => false,
    'errors' => [],
    'message' => ''
];

/**
 * sanitizeInput($input)
 * 
 * Cleans user input to prevent security issues
 * Removes any potentially harmful characters
 * 
 * PARAMETERS:
 * - $input: The user input to sanitize
 * 
 * RETURNS: Cleaned input string
 */
function sanitizeInput($input) {
    // Remove extra whitespace from beginning and end
    $input = trim($input);
    
    // Remove any backslashes added by magic quotes (old PHP versions)
    $input = stripslashes($input);
    
    // Convert special characters to HTML entities for display safety
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    
    return $input;
}

/**
 * validateEmail($email)
 * 
 * Validates email format using multiple methods
 * 
 * PARAMETERS:
 * - $email: Email address to validate
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateEmail($email) {
    // Method 1: Use PHP's built-in email filter
    // FILTER_VALIDATE_EMAIL checks standard email format
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * validatePhone($phone)
 * 
 * Validates phone number format
 * Accepts 10-digit phone numbers
 * 
 * PARAMETERS:
 * - $phone: Phone number to validate
 * 
 * RETURNS: true if valid (10 digits), false otherwise
 */
function validatePhone($phone) {
    // Regular expression: exactly 10 digits
    // ^[0-9]{10}$ means:
    // ^ = start of string
    // [0-9] = any digit 0-9
    // {10} = exactly 10 times
    // $ = end of string
    return preg_match('/^[0-9]{10}$/', $phone) === 1;
}

/**
 * validateName($name)
 * 
 * Validates name format
 * Only allows letters and spaces
 * 
 * PARAMETERS:
 * - $name: Name to validate
 * 
 * RETURNS: true if valid, false otherwise
 */
function validateName($name) {
    // Regular expression: letters and spaces only
    // [a-zA-Z\s] means any letter a-z, A-Z, or whitespace
    return preg_match('/^[a-zA-Z\s]+$/', $name) === 1 && strlen($name) >= 3;
}

// ═══════════════════════════════════════════════════════════════
// MAIN FORM PROCESSING LOGIC
// ═══════════════════════════════════════════════════════════════

// Check if form was submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form data from $_POST array
    // $_POST contains data submitted through HTML form with method="POST"
    
    // Get and sanitize name
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    
    // Get and sanitize email
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    
    // Get and sanitize phone
    $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
    
    // Get and sanitize subject
    $subject = isset($_POST['subject']) ? sanitizeInput($_POST['subject']) : '';
    
    // Get and sanitize message
    // Preserve newlines for better message formatting
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';
    
    // ─────────────────────────────────────────────────────────
    // VALIDATION PHASE
    // ─────────────────────────────────────────────────────────
    
    // Validate name field
    if (empty($name)) {
        $response['errors']['name'] = 'Name is required';
    } elseif (!validateName($name)) {
        $response['errors']['name'] = 'Name must be at least 3 characters and contain only letters';
    }
    
    // Validate email field
    if (empty($email)) {
        $response['errors']['email'] = 'Email is required';
    } elseif (!validateEmail($email)) {
        $response['errors']['email'] = 'Invalid email format';
    }
    
    // Validate phone field
    if (empty($phone)) {
        $response['errors']['phone'] = 'Phone number is required';
    } elseif (!validatePhone($phone)) {
        $response['errors']['phone'] = 'Phone must be exactly 10 digits';
    }
    
    // Validate subject field
    if (empty($subject)) {
        $response['errors']['subject'] = 'Subject is required';
    } elseif (strlen($subject) < 3) {
        $response['errors']['subject'] = 'Subject must be at least 3 characters';
    }
    
    // Validate message field
    if (empty($message)) {
        $response['errors']['message'] = 'Message is required';
    } elseif (strlen($message) < 10) {
        $response['errors']['message'] = 'Message must be at least 10 characters';
    }
    
    // ─────────────────────────────────────────────────────────
    // PROCESS IF NO ERRORS
    // ─────────────────────────────────────────────────────────
    
    // If no validation errors found, process the form
    if (empty($response['errors'])) {
        // In a real application, you would:
        // 1. Send email notification
        // 2. Store data in database
        // 3. Send confirmation to user
        
        // For demo purposes, we just display success
        $response['success'] = true;
        $response['message'] = 'Thank you! Your message has been received. We will reply shortly.';
        
        // Log the submitted data (in production, store in database)
        // error_log() writes to PHP error log
        error_log("Contact form submitted: Name: $name, Email: $email, Phone: $phone");
        
    } else {
        // If there are errors, send them back to the form
        $response['message'] = 'Please correct the errors below and try again.';
    }
    
} else {
    // If not a POST request, show error
    $response['message'] = 'Invalid request method. Please submit the form.';
}

// Convert response array to JSON and send to client
// json_encode() converts PHP array to JSON format
echo json_encode($response);
?>