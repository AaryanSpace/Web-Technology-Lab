# Web Technology Lab Record - Exercises 8, 9, 10 Complete Solution
## Backend Integration: PHP Form Handling, MySQL Database, and Sessions

---

## 📋 TABLE OF CONTENTS
1. [Exercise 8: PHP Form Handling](#exercise-8-php-form-handling)
2. [Exercise 9: PHP + MySQL Integration](#exercise-9-php--mysql-integration)
3. [Exercise 10: Sessions & Cookie Management](#exercise-10-sessions--cookie-management)
4. [Deployment Instructions](#deployment-instructions)
5. [API Endpoints Reference](#api-endpoints-reference)

---

## Exercise 8: PHP Form Handling

### **Purpose**
Demonstrates server-side form validation, input sanitization, and AJAX submission for secure data processing.

### **Files Modified**
- `Ex-3-Personal-Style-CSS/contact.html` - Updated with AJAX form submission
- `Ex-4-E-Commerce-Style-CSS/login.html` - Updated with login form handling
- `Ex-4-E-Commerce-Style-CSS/register.html` - New registration form
- `Ex-8-PHP-Forms/process_contact.php` - Contact form processor
- `Ex-8-PHP-Forms/process_ecommerce_forms.php` - Login/Register processor

### **Key Concepts**
```php
// 1. Form Data Retrieval
$_POST['field_name']           // Access submitted form data
$_SERVER['REQUEST_METHOD']     // Check if POST request

// 2. Input Sanitization
htmlspecialchars()             // Prevent XSS attacks
trim() & stripslashes()        // Clean whitespace

// 3. Validation Functions
filter_var($email, FILTER_VALIDATE_EMAIL)  // Validate email
preg_match('/pattern/', $input)            // Regex validation
strlen() & empty()             // String length checks

// 4. JSON Response
header('Content-Type: application/json')
json_encode($response)         // Send JSON to AJAX
```

### **Form Submission Flow**
```
HTML Form (with id)
    ↓
JavaScript Event Listener (submit)
    ↓
FormData() object
    ↓
fetch() to PHP endpoint (POST)
    ↓
PHP Validation & Sanitization
    ↓
JSON Response
    ↓
JavaScript Error Display or Success Message
```

### **Example: Contact Form Integration**
```html
<form id="contactForm">
    <input type="text" name="name" required>
    <input type="email" name="email" required>
    <input type="tel" name="phone">
    <textarea name="message"></textarea>
    <button type="submit">Send</button>
</form>

<script>
document.getElementById('contactForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    
    const response = await fetch('http://aaryansah.my-style.in/pahirango/process_contact.php', {
        method: 'POST',
        body: formData
    });
    
    const data = await response.json();
    if (data.success) {
        // Show success message
    } else {
        // Display validation errors
    }
});
</script>
```

---

## Exercise 9: PHP + MySQL Integration

### **Purpose**
Demonstrates database operations, prepared statements, and RESTful API endpoints for dynamic product management.

### **Files Modified**
- `Ex-9-PHP-MySQL/config.php` - Database connection configuration
- `Ex-9-PHP-MySQL/api.php` - Product API endpoints
- `Ex-9-PHP-MySQL/DATABASE_SETUP.sql` - Database schema and sample data

### **Database Schema**

#### **Products Table**
```sql
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150),
    category VARCHAR(50),
    price DECIMAL(10, 2),
    description TEXT,
    image VARCHAR(255),
    quantity INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### **Sample Data**
```sql
INSERT INTO products VALUES
(1, 'Blue Silk Saree', 'women', 2500.00, 'Elegant saree', 'saree.jpg', 15, NOW()),
(2, 'Black Formal Shirt', 'men', 1500.00, 'Office wear', 'shirt.jpg', 25, NOW()),
(3, 'Red Lipstick', 'cosmetics', 450.00, 'Matte red', 'lipstick.jpg', 40, NOW());
```

### **API Endpoints**

#### **1. Get All Products**
```
GET /api.php?action=all
```
**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Blue Silk Saree",
            "category": "women",
            "price": "2500.00",
            "description": "Elegant saree",
            "image": "saree.jpg"
        }
    ],
    "message": "25 products found"
}
```

#### **2. Get Products by Category**
```
GET /api.php?action=category&cat=women
```
**Response:** Same as above, filtered by category

#### **3. Search Products**
```
GET /api.php?action=search&q=shirt
```
**Response:** Products matching search term

#### **4. Get Single Product**
```
GET /api.php?action=product&id=1
```
**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Blue Silk Saree",
        "quantity": 15,
        ...
    }
}
```

### **Key Concepts**

#### **Database Connection (MySQLi)**
```php
$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

$connection->set_charset('utf8mb4');
```

#### **Prepared Statements (Prevent SQL Injection)**
```php
// Instead of:
$query = "SELECT * FROM products WHERE id = " . $_GET['id'];

// Use prepared statements:
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param('i', $productId);  // 'i' = integer
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
```

#### **Dynamic Product Display (JavaScript)**
```html
<!-- In your e-commerce index.html -->
<div id="productContainer"></div>

<script>
// Fetch products from API
async function loadProducts() {
    const response = await fetch('http://aaryansah.my-style.in/pahirango/api.php?action=all');
    const data = await response.json();
    
    const html = data.data.map(product => `
        <div class="product-card">
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p class="price">₹${product.price}</p>
            <button onclick="addToCart(${product.id})">Add to Cart</button>
        </div>
    `).join('');
    
    document.getElementById('productContainer').innerHTML = html;
}

loadProducts();
</script>
```

---

## Exercise 10: Sessions & Cookie Management

### **Purpose**
Implements user authentication with sessions and persistent shopping cart functionality.

### **Files Created**
- `Ex-10-Sessions-Cookies/session_handler.php` - Session and cart management

### **Key Concepts**

#### **Session Initialization**
```php
// MUST be at the top of every session file
session_start();

// Set session timeout (30 minutes)
$_SESSION['last_activity'] = time();
```

#### **User Login (Store Session)**
```php
function loginUser($email, $name) {
    $_SESSION['logged_in'] = true;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $name;
    $_SESSION['login_time'] = time();
    $_SESSION['cart'] = [];
}
```

#### **Check If User Logged In**
```php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is logged in
    echo "Welcome, " . $_SESSION['user_name'];
}
```

#### **Shopping Cart Functions**
```php
// Add to cart
$_SESSION['cart'][1] = 2;  // Product ID 1, Quantity 2

// Get cart
$cart = $_SESSION['cart'];

// Calculate total items
$totalItems = array_sum($_SESSION['cart']);

// Clear cart
$_SESSION['cart'] = [];
```

#### **User Preferences (Cookies)**
```php
// Set cookie (persists 30 days)
setcookie('theme', 'dark', time() + (30 * 24 * 60 * 60), '/');

// Get cookie
$theme = $_COOKIE['theme'] ?? 'light';

// Delete cookie
setcookie('theme', '', time() - 3600, '/');
```

#### **Session Timeout Check**
```php
$timeout = 1800;  // 30 minutes

if (isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > $timeout) {
        session_destroy();
        // Redirect to login
    }
}

$_SESSION['last_activity'] = time();
```

#### **Logout (Destroy Session)**
```php
function logoutUser() {
    $_SESSION = [];
    session_destroy();
    
    // Delete session cookie
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, 
                  $params['path'], $params['domain']);
    }
}
```

---

## Deployment Instructions

### **Step 1: Upload Files to InfinityFree**

1. Login to your InfinityFree hosting control panel
2. Go to **File Manager**
3. Create folders:
   - `/pahirango/` - Main e-commerce folder
   - `/portfolio/` - Portfolio website folder

4. Upload these PHP files to `/pahirango/`:
   - `config.php`
   - `api.php`
   - `process_contact.php`
   - `process_ecommerce_forms.php`
   - `session_handler.php`

### **Step 2: Create MySQL Database**

1. Go to **MySQL Databases** in control panel
2. Create database named `pahirango_db`
3. Go to **PhpMyAdmin**
4. Select your database
5. Click **SQL** tab
6. Copy and paste content from `DATABASE_SETUP.sql`
7. Click **Go** to execute

### **Step 3: Update config.php**

Replace database credentials with your hosting details:
```php
define('DB_HOST', 'your-db-host.com');
define('DB_USER', 'your-db-username');
define('DB_PASSWORD', 'your-db-password');
define('DB_NAME', 'your-db-name');
```

### **Step 4: Update Form URLs**

In all HTML forms, update the fetch URL to your domain:
```javascript
// Change this:
const response = await fetch('http://aaryansah.my-style.in/pahirango/process_contact.php', {

// To your domain:
const response = await fetch('http://your-domain.com/pahirango/process_contact.php', {
```

---

## API Endpoints Reference

### **Contact Form Submission**
```
POST /pahirango/process_contact.php
Content-Type: application/x-www-form-urlencoded

Fields:
- name (required)
- email (required)
- phone (optional)
- message (required)
```

### **E-Commerce Login**
```
POST /pahirango/process_ecommerce_forms.php
Content-Type: application/x-www-form-urlencoded

Fields:
- formType=login
- email
- password
```

### **E-Commerce Registration**
```
POST /pahirango/process_ecommerce_forms.php
Content-Type: application/x-www-form-urlencoded

Fields:
- formType=register
- name
- email
- password
- confirmPassword
```

### **Get All Products**
```
GET /pahirango/api.php?action=all
Response: JSON array of products
```

### **Get Products by Category**
```
GET /pahirango/api.php?action=category&cat=women
GET /pahirango/api.php?action=category&cat=men
GET /pahirango/api.php?action=category&cat=cosmetics
Response: JSON array of products in category
```

### **Search Products**
```
GET /pahirango/api.php?action=search&q=shirt
Response: JSON array of matching products
```

---

## Validation Rules Summary

### **Contact Form (Ex-3)**
- **Name**: 3+ characters, letters and spaces only
- **Email**: Valid email format
- **Phone**: 10 digits (optional)
- **Message**: 10-500 characters

### **E-Commerce Login (Ex-4)**
- **Email**: Valid email format
- **Password**: Any length

### **E-Commerce Registration (Ex-4)**
- **Name**: 3+ characters
- **Email**: Valid and unique
- **Password**: 8+ chars, 1 uppercase, 1 lowercase, 1 digit
- **Confirm Password**: Must match password

---

## Testing Checklist

- [ ] Contact form submits and displays errors
- [ ] Login form validates email and password
- [ ] Registration form checks password strength
- [ ] Products load from database
- [ ] Category filtering works
- [ ] Product search returns results
- [ ] Session persists across pages (if implemented in pages)
- [ ] Shopping cart updates session data

---

## Security Best Practices Implemented

✅ **SQL Injection Prevention**: Using prepared statements
✅ **XSS Prevention**: Using htmlspecialchars() for output
✅ **CSRF Protection**: Simple token validation possible
✅ **Password Security**: Using password_hash() for hashing
✅ **Session Security**: HTTP-only cookies, session timeouts
✅ **Input Validation**: Both client-side and server-side
✅ **Error Handling**: Try-catch blocks and error logging

---

## Troubleshooting

### **"Database connection failed"**
- Check credentials in config.php
- Verify database exists in PhpMyAdmin
- Check that SQL setup script was executed

### **"CORS error when fetching from API"**
- Make sure headers are set in PHP files:
  ```php
  header('Access-Control-Allow-Origin: *');
  ```

### **"Forms not submitting"**
- Check console for JavaScript errors (F12)
- Verify fetch URL matches your domain
- Check that PHP files are on server

### **"Session not persisting"**
- Ensure session_start() is at the top of file
- Check that cookies are enabled in browser
- Verify session.save_path is writable on server

---

## File Structure Summary

```
Web-Tech-Lab-Record/
├── index.html (Updated with Ex-8,9,10 boxes)
├── Ex-1-Personal-Website-HTML/
├── Ex-2-E-Commerce-Website-HTML/
├── Ex-3-Personal-Style-CSS/
│   └── contact.html (Updated with AJAX)
├── Ex-4-E-Commerce-Style-CSS/
│   ├── login.html (Updated with AJAX)
│   └── register.html (New)
├── Ex-5-Calculator-JavaScript/
├── Ex-6-Forms-JavaScript-Validation/
├── Ex-7-Event-Handling/
├── Ex-8-PHP-Forms/
│   ├── process_contact.php (New)
│   └── process_ecommerce_forms.php (Updated)
├── Ex-9-PHP-MySQL/
│   ├── config.php (Updated)
│   ├── api.php (Updated)
│   └── DATABASE_SETUP.sql (New)
└── Ex-10-Sessions-Cookies/
    └── session_handler.php (Updated)
```

---

## Next Steps for Production

1. Implement email notifications for forms
2. Add database record storage for form submissions
3. Create admin dashboard for product management
4. Implement secure user authentication with password reset
5. Add payment gateway integration
6. Set up SSL/HTTPS certificate
7. Implement rate limiting for API endpoints
8. Add caching for better performance

---

**Created by**: Aaryan Sah (24BTRCN054)
**Course**: Web Technology Lab (23CSE404)
**Faculty**: Mr. Junaid Rasool
**Date**: April 2026
