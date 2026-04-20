<?php
/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 8: PHP FORM HANDLING & VALIDATION
 * PERSONAL PORTFOLIO CONTACT FORM PROCESSOR
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * - Server-side form validation in PHP
 * - Input sanitization to prevent security issues
 * - Processing contact form submissions
 * - Email notifications
 * 
 * CONCEPTS COVERED:
 * 1. $_POST superglobal for form data
 * 2. isset() and empty() for validation
 * 3. Regular expressions (preg_match) for pattern matching
 * 4. htmlspecialchars() for XSS prevention
 * 5. filter_var() for email validation
 * 6. JSON responses for AJAX
 */

// Enable CORS for development
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=utf-8');

// Initialize response
$response = [
    'success' => false,
    'errors' => [],
    'message' => ''
];

/**
 * Sanitize user input
 * Removes whitespace, escapes HTML, prevents XSS
 */
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

/**
 * Validate email address
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number (10 digits)
 */
function validatePhone($phone) {
    return preg_match('/^[0-9]{10}$/', $phone) === 1;
}

/**
 * Validate name (letters and spaces only, min 3 chars)
 */
function validateName($name) {
    return preg_match('/^[a-zA-Z\s]+$/', $name) === 1 && strlen($name) >= 3;
}

// ═══════════════════════════════════════════════════════════════
// PROCESS FORM SUBMISSION
// ═══════════════════════════════════════════════════════════════

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get and sanitize form data
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';
    
    // ─────────────────────────────────────────────────────────
    // VALIDATION PHASE
    // ─────────────────────────────────────────────────────────
    
    // Validate name
    if (empty($name)) {
        $response['errors']['name'] = 'Name is required';
    } elseif (!validateName($name)) {
        $response['errors']['name'] = 'Name must be at least 3 characters (letters and spaces only)';
    }
    
    // Validate email
    if (empty($email)) {
        $response['errors']['email'] = 'Email is required';
    } elseif (!validateEmail($email)) {
        $response['errors']['email'] = 'Please enter a valid email address';
    }
    
    // Validate phone (optional, but validate if provided)
    if (!empty($phone) && !validatePhone($phone)) {
        $response['errors']['phone'] = 'Phone must be 10 digits';
    }
    
    // Validate message
    if (empty($message)) {
        $response['errors']['message'] = 'Message is required';
    } elseif (strlen($message) < 10) {
        $response['errors']['message'] = 'Message must be at least 10 characters';
    } elseif (strlen($message) > 500) {
        $response['errors']['message'] = 'Message must not exceed 500 characters';
    }
    
    // ─────────────────────────────────────────────────────────
    // PROCESS IF NO ERRORS
    // ─────────────────────────────────────────────────────────
    
    if (empty($response['errors'])) {
        try {
            // In production, you would save to database or send email
            // For now, we'll just create a log file
            
            $timestamp = date('Y-m-d H:i:s');
            $logEntry = "[{$timestamp}] Name: {$name} | Email: {$email} | Phone: {$phone} | Message: {$message}\n";
            
            // Save to log file
            $logFile = __DIR__ . '/contact_submissions.log';
            file_put_contents($logFile, $logEntry, FILE_APPEND);
            
            // Optional: Send email notification
            // $to = 'aaryansah.space@gmail.com';
            // $subject = "New Contact Form Submission from {$name}";
            // $mailBody = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\n\nMessage:\n{$message}";
            // mail($to, $subject, $mailBody);
            
            $response['success'] = true;
            $response['message'] = 'Your message has been sent successfully!';
        } catch (Exception $e) {
            $response['errors']['form'] = 'An error occurred while processing your form. Please try again later.';
        }
    }
    
} else {
    $response['errors']['form'] = 'Invalid request method. Only POST is allowed.';
}

// Send JSON response
echo json_encode($response);
exit;
?>
