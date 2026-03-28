<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 8 - README</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.8;
            max-width: 900px;
            margin: 0 auto;
            padding: 40px;
            background: #f5f5f5;
            color: #333;
        }
        
        h1, h2, h3 {
            color: #667eea;
            margin-top: 30px;
        }
        
        code {
            background: #e8eaf6;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
        }
        
        pre {
            background: #f5f5f5;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
        }
        
        .important {
            background: #fff3cd;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
        }
        
        ul {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <h1>Exercise 8: PHP Form Handling & Validation</h1>
    
    <h2>Overview</h2>
    <p>
        This exercise demonstrates server-side form processing and validation using PHP. Learn how to safely handle user input and prevent security vulnerabilities.
    </p>
    
    <h2>What We're Learning</h2>
    <ul>
        <li><strong>$_POST and $_REQUEST</strong> - Accessing form data submitted by users</li>
        <li><strong>isset() and empty()</strong> - Checking if variables exist and have values</li>
        <li><strong>preg_match()</strong> - Pattern matching with regular expressions</li>
        <li><strong>htmlspecialchars()</strong> - Preventing XSS attacks</li>
        <li><strong>filter_var()</strong> - Built-in input validation functions</li>
        <li><strong>password_hash()</strong> - Secure password encryption with bcrypt</li>
        <li><strong>JSON responses</strong> - Sending structured responses back to JavaScript</li>
    </ul>
    
    <h2>File Structure</h2>
    <pre>
Ex-8-PHP-Forms/
├── index.html                           (HTML forms)
├── process_personal_contact.php         (Contact form processor)
├── process_ecommerce_forms.php          (E-commerce forms processor)
└── README.md                            (This file)
    </pre>
    
    <h2>How to Run</h2>
    <div class="important">
        <strong>⚠️ Important:</strong> You need a PHP server to run these scripts. Local HTML files cannot execute PHP.
        <br><br>
        Options:
        <ul>
            <li>Use <code>php -S localhost:8000</code> in the project folder</li>
            <li>Use XAMPP, WAMP, or MAMP</li>
            <li>Upload to a web hosting server</li>
        </ul>
    </div>
    
    <h2>Key Concepts Explained</h2>
    
    <h3>1. Sanitizing User Input</h3>
    <p>Never trust user input. Always clean it before processing:</p>
    <pre>
function sanitizeInput($input) {
    $input = trim($input);           // Remove whitespace
    $input = stripslashes($input);   // Remove slashes
    $input = htmlspecialchars($input); // Convert special chars
    return $input;
}
    </pre>
    
    <h3>2. Validating Email</h3>
    <pre>
function validateEmail($email) {
    // PHP built-in email filter
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
    </pre>
    
    <h3>3. Regex Pattern Matching</h3>
    <pre>
// Validate 10-digit phone number
preg_match('/^[0-9]{10}$/', $phone)

// Explanation:
// ^ = start of string
// [0-9] = any digit 0 through 9
// {10} = exactly 10 times
// $ = end of string
    </pre>
    
    <h3>4. Secure Password Hashing</h3>
    <pre>
// Hash password with bcrypt (one-way encryption)
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Later, verify password:
if (password_verify($inputPassword, $hashedPassword)) {
    // Password is correct!
}
    </pre>
    
    <h3>5. Form Data Processing</h3>
    <pre>
// Check if form submitted with POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    
    // Validate
    $errors = [];
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }
    
    // If errors, return them
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }
}
    </pre>
    
    <h2>Security Best Practices</h2>
    <ul>
        <li>✓ Always validate on the server (client validation can be bypassed)</li>
        <li>✓ Use <code>htmlspecialchars()</code> to prevent XSS attacks</li>
        <li>✓ Use <code>password_hash()</code> for passwords, never store plain text</li>
        <li>✓ Use prepared statements for database queries (prevents SQL injection)</li>
        <li>✓ Check request method (<code>REQUEST_METHOD</code>)</li>
        <li>✓ Use HTTPS in production to encrypt data in transit</li>
    </ul>
    
    <h2>Testing the Forms</h2>
    <p>In the <code>index.html</code> file, you'll find two forms to test:</p>
    
    <h3>Form 1: Contact Form (Personal Website)</h3>
    <p>Validates:</p>
    <ul>
        <li>Name: 3+ characters, letters only</li>
        <li>Email: Valid email format</li>
        <li>Phone: Exactly 10 digits</li>
        <li>Subject: 3+ characters</li>
        <li>Message: 10+ characters</li>
    </ul>
    
    <h3>Form 2: Registration Form (E-Commerce)</h3>
    <p>Validates:</p>
    <ul>
        <li>Full Name: 3+ characters</li>
        <li>Email: Valid email format</li>
        <li>Phone: Exactly 10 digits</li>
        <li>Passwords: 8+ characters, must match</li>
        <li>Address: 10+ characters</li>
        <li>Postal Code: 5-6 digits</li>
    </ul>
    
    <h2>Response Flow</h2>
    <pre>
1. User fills form and clicks Submit
                ↓
2. JavaScript captures form submission
                ↓
3. Data sent to PHP script via fetch()
                ↓
4. PHP validates data (sanitize + check format)
                ↓
5. If valid → process, return success
   If invalid → return error messages
                ↓
6. JavaScript receives JSON response
                ↓
7. Display success or show errors to user
    </pre>
    
    <h2>Output Examples</h2>
    
    <h3>Success Response (JSON)</h3>
    <pre>
{
    "success": true,
    "message": "Thank you! Your message has been received.",
    "errors": []
}
    </pre>
    
    <h3>Error Response (JSON)</h3>
    <pre>
{
    "success": false,
    "message": "Please correct the errors",
    "errors": {
        "email": "Invalid email format",
        "phone": "Phone must be exactly 10 digits"
    }
}
    </pre>
    
    <h2>Questions to Test Your Knowledge</h2>
    <ul>
        <li>Why is server-side validation important if we already validated on the client?</li>
        <li>What does <code>htmlspecialchars()</code> prevent?</li>
        <li>What is a regular expression and why use it?</li>
        <li>Why should passwords never be stored in plain text?</li>
        <li>What's the difference between <code>isset()</code> and <code>empty()</code>?</li>
        <li>How does <code>password_verify()</code> work if we can't decrypt the hash?</li>
    </ul>
    
    <div class="important">
        Next: Learn to store this data in MySQL databases (Exercise 9)
    </div>
</body>
</html>
