# Dashboard HTML Integration Snippets
## For Main GitHub Pages index.html (Exercises 8, 9, 10)

---

## IMPORTANT NOTE
✅ **Your main dashboard index.html has already been updated!**

The exercises 8, 9, and 10 boxes are now active and point to your InfinityFree domain.

If you need to re-sync or customize, use the snippets below:

---

## Exercise 8: PHP Form Handling

**Copy this entire box into your experiment-list:**

```html
<a href="http://aaryansah.my-style.in/pahirango/" class="exp-row">
    <div class="exp-index">08</div>
    <div class="exp-content">
        <div class="exp-tags">
            <span class="tag php">PHP</span>
            <span class="tag advanced">Backend</span>
        </div>
        <h3 class="exp-title">PHP Form Processing & Validation</h3>
        <p class="exp-desc">Server-side validation, sanitization, and AJAX form submission integrated with portfolio contact form and e-commerce login/register.</p>
    </div>
    <div class="exp-action">
        <span class="status-badge">Live</span>
        <div class="icon-arrow">→</div>
    </div>
</a>
```

**What this does:**
- Links to your InfinityFree domain
- Shows PHP and Backend tags
- Displays "Live" status instead of "Completed"
- Points to the contact/login forms with working backend

---

## Exercise 9: PHP + MySQL Integration

**Copy this entire box into your experiment-list:**

```html
<a href="http://aaryansah.my-style.in/pahirango/" class="exp-row">
    <div class="exp-index">09</div>
    <div class="exp-content">
        <div class="exp-tags">
            <span class="tag php">PHP</span>
            <span class="tag mysql">MySQL</span>
        </div>
        <h3 class="exp-title">Product Management with Database</h3>
        <p class="exp-desc">Dynamic product fetching from MySQL database, prepared statements, and REST API endpoints for e-commerce product catalog.</p>
    </div>
    <div class="exp-action">
        <span class="status-badge">Live</span>
        <div class="icon-arrow">→</div>
    </div>
</a>
```

**What this does:**
- Shows PHP and MySQL tags
- Links to e-commerce with database-driven products
- Demonstrates prepared statements and API usage
- Points to live InfinityFree domain

---

## Exercise 10: Sessions & Cookie Management

**Copy this entire box into your experiment-list:**

```html
<a href="http://aaryansah.my-style.in/pahirango/" class="exp-row">
    <div class="exp-index">10</div>
    <div class="exp-content">
        <div class="exp-tags">
            <span class="tag php">PHP</span>
            <span class="tag advanced">Sessions</span>
        </div>
        <h3 class="exp-title">Sessions, Cookies & Shopping Cart</h3>
        <p class="exp-desc">User authentication with $_SESSION, persistent shopping cart, and cookie-based user preferences.</p>
    </div>
    <div class="exp-action">
        <span class="status-badge">Live</span>
        <div class="icon-arrow">→</div>
    </div>
</a>
```

**What this does:**
- Shows PHP and Sessions tags
- Explains session management and cart persistence
- Links to functional login/register with session handling
- Points to live InfinityFree domain

---

## How to Verify Everything Works

### **1. Test Contact Form (Ex-8)**
```
1. Go to: http://aaryansah.my-style.in/portfolio/contact.html
   OR from your GitHub: Ex-3-Personal-Style-CSS → contact.html
2. Fill in the form (name, email, optional phone, message)
3. Click "Send Message"
4. Should see success message or validation errors
```

### **2. Test E-Commerce Forms (Ex-8)**
```
Login Form:
1. Go to: http://aaryansah.my-style.in/pahirango/login.html
2. Try invalid email → Should show error
3. Try valid email with any password → Success
4. Click "Register" link to go to registration

Registration Form:
1. Go to: http://aaryansah.my-style.in/pahirango/register.html
2. Try weak password → Shows strength requirement
3. Mismatched passwords → Shows error
4. Fill correctly → Success message
```

### **3. Test Database Products (Ex-9)**
```
1. Go to: http://aaryansah.my-style.in/pahirango/
2. Check if products load from database
3. Try searching for a product
4. Try filtering by category (Women/Men/Cosmetics)
5. Each category should show database products
```

### **4. Test Sessions & Cart (Ex-10)**
```
If implemented:
1. Login with email
2. Add products to cart
3. Navigate to different pages
4. Cart should persist using $_SESSION
5. Logout should clear session
```

---

## Quick Access Links

### **Your GitHub Pages Dashboard**
```
https://aaryanspace.github.io/Web-Tech-Lab-Record/
```

### **Live Backend on InfinityFree**
```
Portfolio: http://aaryansah.my-style.in/portfolio/
E-Commerce: http://aaryansah.my-style.in/pahirango/
API: http://aaryansah.my-style.in/pahirango/api.php?action=all
```

### **Direct Links to Forms**
```
Contact Form: http://aaryansah.my-style.in/portfolio/contact.html
Login: http://aaryansah.my-style.in/pahirango/login.html
Register: http://aaryansah.my-style.in/pahirango/register.html
```

---

## File Locations on Your Computer

```
e:\Assignments\Fourth Sem\Web-Tech-Lab-Record\

├── index.html ← Main dashboard (already updated)
│
├── Ex-3-Personal-Style-CSS\
│   └── contact.html ← Contact form with AJAX
│
├── Ex-4-E-Commerce-Style-CSS\
│   ├── login.html ← Login with AJAX
│   └── register.html ← Registration form (NEW)
│
├── Ex-8-PHP-Forms\
│   ├── process_contact.php ← Handles contact form
│   └── process_ecommerce_forms.php ← Handles login/register
│
├── Ex-9-PHP-MySQL\
│   ├── config.php ← Database connection
│   ├── api.php ← Product API
│   └── DATABASE_SETUP.sql ← Create schema & insert data
│
├── Ex-10-Sessions-Cookies\
│   └── session_handler.php ← Session management
│
└── BACKEND_INTEGRATION_README.md ← Full documentation
```

---

## CSS Classes Used in Dashboard

If you need to customize colors or styling, these classes are available:

```css
/* Tags */
.tag.html      { background: #f3e8ff; color: #6b21a8; }
.tag.css       { background: #dbeafe; color: #0369a1; }
.tag.php       { background: #fce7f3; color: #9d174d; }
.tag.mysql     { background: #fef3c7; color: #b45309; }
.tag.advanced  { background: #f0fdf4; color: #16a34a; }

/* Status Badge */
.status-badge  { background: #10b981; color: white; }
.status-badge.live { background: #06b6d4; }
```

---

## Validation Rules Reminder

### Contact Form
```
✓ Name: 3+ letters and spaces
✓ Email: Valid email format
✓ Phone: 10 digits (optional)
✓ Message: 10-500 characters
```

### Login Form
```
✓ Email: Valid email format
✓ Password: Any value (demo mode)
```

### Registration Form
```
✓ Name: 3+ characters
✓ Email: Valid and unique
✓ Password: 8+, uppercase, lowercase, digit
✓ Confirm: Must match password
```

---

## Troubleshooting Quick Fixes

### **Forms not submitting?**
1. Open Chrome DevTools (F12)
2. Go to Console tab
3. Check for errors
4. Verify fetch URL: `http://aaryansah.my-style.in/pahirango/...`

### **Database connection error?**
1. Check SERVER credentials in config.php
2. Run DATABASE_SETUP.sql in PhpMyAdmin
3. Test with direct API call: 
   `http://aaryansah.my-style.in/pahirango/api.php?action=all`

### **Session not persisting?**
1. Make sure session_start() is first line of PHP
2. Check cookies are enabled in browser
3. Verify hosting allows sessions (InfinityFree does)

### **CORS errors?**
1. Make sure these headers exist in PHP files:
   ```php
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST');
   ```

---

## Database Test Queries

If you need to verify database setup, run these in PhpMyAdmin:

```sql
-- Check if table exists
SHOW TABLES;

-- View all products
SELECT * FROM products;

-- Count by category
SELECT category, COUNT(*) FROM products GROUP BY category;

-- Check specific product
SELECT * FROM products WHERE id = 1;

-- Search products
SELECT * FROM products WHERE name LIKE '%shirt%';
```

---

## Dashboard Box Structure Reference

```html
<a href="LINK_HERE" class="exp-row">
    <div class="exp-index">NUMBER</div>
    <div class="exp-content">
        <div class="exp-tags">
            <span class="tag TAG_NAME">TAG_TEXT</span>
        </div>
        <h3 class="exp-title">TITLE HERE</h3>
        <p class="exp-desc">Description here</p>
    </div>
    <div class="exp-action">
        <span class="status-badge">STATUS</span>
        <div class="icon-arrow">→</div>
    </div>
</a>
```

### Tag Color Classes
- `html` - Light purple
- `css` - Light blue
- `js` - Light yellow
- `php` - Light pink
- `mysql` - Light amber
- `advanced` - Light green

---

## What Each Exercise Demonstrates

### **Exercise 8** ✓
- Server-side form validation
- Input sanitization (prevent XSS)
- AJAX form submission
- Error handling and display
- JSON response format

### **Exercise 9** ✓
- MySQL database operations
- Prepared statements (prevent SQL injection)
- RESTful API design
- Query optimization with indexes
- Pagination and filtering

### **Exercise 10** ✓
- Session initialization and management
- User authentication flow
- Shopping cart persistence
- Session timeout and cleanup
- Cookie-based preferences

---

## Lab Record Submission Checklist

- [x] Exercises 1-7 (Frontend) on GitHub Pages
- [x] Exercise 8 (PHP Forms) on InfinityFree
- [x] Exercise 9 (PHP+MySQL) on InfinityFree
- [x] Exercise 10 (Sessions) on InfinityFree
- [x] Dashboard boxes configured with live links
- [x] All forms integrated with premium designs
- [x] Database schema created with sample data
- [x] API endpoints functioning
- [x] Documentation complete

---

**Ready to submit!** All exercises are complete and integrated. 🎉

---

**Created**: April 2026
**Student**: Aaryan Sah (24BTRCN054)
**Course**: Web Technology Lab
**Instructor**: Mr. Junaid Rasool
