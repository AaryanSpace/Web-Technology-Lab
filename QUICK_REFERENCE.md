# 🚀 QUICK REFERENCE CARD - Exercises 8, 9, 10

## YOUR DOMAIN (Update in all PHP files & fetch URLs)
```
http://aaryansah.my-style.in/pahirango/
```

---

## ⚡ EXERCISE 8: PHP FORM HANDLING

### Files Updated:
- ✅ `Ex-3-Personal-Style-CSS/contact.html` - AJAX contact form
- ✅ `Ex-4-E-Commerce-Style-CSS/login.html` - AJAX login
- ✅ `Ex-4-E-Commerce-Style-CSS/register.html` - NEW registration
- ✅ `Ex-8-PHP-Forms/process_contact.php` - Contact processor
- ✅ `Ex-8-PHP-Forms/process_ecommerce_forms.php` - Auth processor

### Test URLs:
```
Portfolio Contact: http://aaryansah.my-style.in/portfolio/contact.html
E-commerce Login: http://aaryansah.my-style.in/pahirango/login.html
E-commerce Register: http://aaryansah.my-style.in/pahirango/register.html
```

### Key Code (Form Submission):
```javascript
fetch('http://aaryansah.my-style.in/pahirango/process_contact.php', {
    method: 'POST',
    body: new FormData(form)
})
.then(r => r.json())
.then(data => {
    if (data.success) { /* success */ }
    else { /* show errors */ }
});
```

---

## 📊 EXERCISE 9: PHP + MYSQL

### Files Created:
- ✅ `Ex-9-PHP-MySQL/config.php` - DB connection
- ✅ `Ex-9-PHP-MySQL/api.php` - Product API
- ✅ `Ex-9-PHP-MySQL/DATABASE_SETUP.sql` - Schema

### Database Setup:
```sql
1. Create database "pahirango_db" in PhpMyAdmin
2. Go to SQL tab
3. Copy content from DATABASE_SETUP.sql
4. Execute (Click "Go")
5. Done! 20+ products added
```

### API Endpoints:
```
All Products: /api.php?action=all
By Category: /api.php?action=category&cat=women
Search: /api.php?action=search&q=shirt
Single: /api.php?action=product&id=1
```

### Key Code (Prepared Statements):
```php
$stmt = $connection->prepare("SELECT * FROM products WHERE category = ?");
$stmt->bind_param('s', $category);  // 's'=string, 'i'=integer
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) { /* process */ }
```

---

## 🔐 EXERCISE 10: SESSIONS & COOKIES

### File Updated:
- ✅ `Ex-10-Sessions-Cookies/session_handler.php` - Sessions & cart

### Key Code (Session Login):
```php
session_start();  // ALWAYS first!

$_SESSION['logged_in'] = true;
$_SESSION['user_email'] = 'user@email.com';
$_SESSION['cart'] = [];
```

### Key Code (Add to Cart):
```php
$_SESSION['cart'][productId] = quantity;
$total = array_sum($_SESSION['cart']);
```

### Key Code (Logout):
```php
$_SESSION = [];
session_destroy();
```

---

## ✅ DEPLOYMENT CHECKLIST

### Before Uploading:
- [ ] Update `config.php` with InfinityFree credentials
- [ ] Update all fetch() URLs to your domain
- [ ] Test locally first (optional)
- [ ] Run DATABASE_SETUP.sql in PhpMyAdmin

### Upload to InfinityFree:
- [ ] Create `/pahirango/` folder in File Manager
- [ ] Upload: config.php, api.php, process_*.php, session_handler.php
- [ ] Verify permissions (644 for files, 755 for folders)

### Verify Working:
- [ ] Contact form submits → Check logs
- [ ] Login form validates → No errors
- [ ] Products load from DB → `/api.php?action=all`
- [ ] Cart persists → Session data saved

---

## 🔗 GITHUB PAGES INTEGRATION

### Box 08 Link:
```html
<a href="http://aaryansah.my-style.in/pahirango/" class="exp-row">
    <div class="exp-index">08</div>
    <div class="exp-content">
        <div class="exp-tags">
            <span class="tag php">PHP</span>
            <span class="tag advanced">Backend</span>
        </div>
        <h3 class="exp-title">PHP Form Processing & Validation</h3>
        <p class="exp-desc">AJAX forms with server-side validation & sanitization</p>
    </div>
    <div class="exp-action">
        <span class="status-badge">Live</span>
        <div class="icon-arrow">→</div>
    </div>
</a>
```

### Box 09 Link:
```html
<a href="http://aaryansah.my-style.in/pahirango/" class="exp-row">
    <div class="exp-index">09</div>
    <div class="exp-content">
        <div class="exp-tags">
            <span class="tag php">PHP</span>
            <span class="tag mysql">MySQL</span>
        </div>
        <h3 class="exp-title">Product Database & APIs</h3>
        <p class="exp-desc">Prepared statements, REST APIs, dynamic product display</p>
    </div>
    <div class="exp-action">
        <span class="status-badge">Live</span>
        <div class="icon-arrow">→</div>
    </div>
</a>
```

### Box 10 Link:
```html
<a href="http://aaryansah.my-style.in/pahirango/" class="exp-row">
    <div class="exp-index">10</div>
    <div class="exp-content">
        <div class="exp-tags">
            <span class="tag php">PHP</span>
            <span class="tag advanced">Sessions</span>
        </div>
        <h3 class="exp-title">Auth & Shopping Cart</h3>
        <p class="exp-desc">Session management, user authentication, persistent cart</p>
    </div>
    <div class="exp-action">
        <span class="status-badge">Live</span>
        <div class="icon-arrow">→</div>
    </div>
</a>
```

✅ **Already updated in your index.html!**

---

## 🐛 COMMON ISSUES & FIXES

| Issue | Fix |
|-------|-----|
| "Database connection failed" | Check credentials in config.php |
| "CORS error" | Add `header('Access-Control-Allow-Origin: *');` to PHP |
| "Forms not submitting" | Check F12 console, verify fetch URL |
| "Products not loading" | Run DATABASE_SETUP.sql, check API response |
| "Session lost on page reload" | Verify `session_start()` is first line |
| "Cart empties after refresh" | Ensure session_start() in all files |

---

## 📋 VALIDATION RULES

### Contact Form (Ex-3)
| Field | Rule |
|-------|------|
| Name | 3+ letters/spaces |
| Email | Valid format |
| Phone | 10 digits (optional) |
| Message | 10-500 chars |

### Login (Ex-4)
| Field | Rule |
|-------|------|
| Email | Valid format |
| Password | Any value |

### Register (Ex-4)
| Field | Rule |
|-------|------|
| Name | 3+ chars |
| Email | Valid & unique |
| Password | 8+, UPPERCASE, digit |
| Confirm | Must match |

---

## 📁 FILE STRUCTURE

```
Your Work Folder:
├── index.html                              ← Dashboard
├── Ex-3-Personal-Style-CSS/
│   └── contact.html                       ← Contact form
├── Ex-4-E-Commerce-Style-CSS/
│   ├── login.html                         ← Login form
│   └── register.html                      ← Register form
├── Ex-8-PHP-Forms/
│   ├── process_contact.php
│   └── process_ecommerce_forms.php
├── Ex-9-PHP-MySQL/
│   ├── config.php
│   ├── api.php
│   └── DATABASE_SETUP.sql
├── Ex-10-Sessions-Cookies/
│   └── session_handler.php
├── BACKEND_INTEGRATION_README.md           ← Full docs
└── DASHBOARD_INTEGRATION_GUIDE.md          ← Integration guide
```

---

## 🎯 SUMMARY

### Ex-8 demonstrates:
✓ Client-side form submission with JavaScript
✓ Server-side validation with PHP
✓ Input sanitization to prevent XSS
✓ Error handling and JSON responses
✓ AJAX for async form submission

### Ex-9 demonstrates:
✓ MySQL database design
✓ Prepared statements (prevent SQL injection)
✓ REST API endpoints
✓ CRUD operations
✓ Dynamic HTML generation from DB

### Ex-10 demonstrates:
✓ PHP session initialization
✓ User authentication flow
✓ Session data management
✓ Shopping cart persistence
✓ Cookie-based preferences

---

## 🚀 READY TO DEPLOY?

1. ✅ Upload PHP files to InfinityFree
2. ✅ Update config.php with credentials
3. ✅ Run DATABASE_SETUP.sql
4. ✅ Test all forms and APIs
5. ✅ Update GitHub Pages dashboard
6. ✅ Submit for evaluation

---

**Status: COMPLETE ✓**
All exercises 8, 9, 10 ready for InfinityFree deployment!
