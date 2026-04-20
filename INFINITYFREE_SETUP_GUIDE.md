# 🚀 Complete InfinityFree Setup Guide for Exercises 8, 9, 10

## 📌 QUICK OVERVIEW

**The 404 error means your PHP files aren't on the server yet.**

You need to:
1. ✅ Upload PHP files via File Manager
2. ✅ Create MySQL database
3. ✅ Import SQL schema
4. ✅ Update config.php with credentials
5. ✅ Test the setup

---

## ⚙️ STEP 1: LOGIN TO INFINITYFREE

Go to: https://www.infinityfree.net/

1. Click **"My Account"** (top right)
2. Enter your **email** and **password**
3. Click **Login**
4. Select your **Account** from the dashboard

---

## 📁 STEP 2: UPLOAD PHP FILES

### 2.1 Open File Manager

1. In your InfinityFree account panel, click **"File Manager"**
2. You'll see folders: `public_html`, `cache`, etc.
3. Double-click **`public_html`** to open it

### 2.2 Create Folder Structure

1. Right-click in empty space → **Create Folder**
2. Name it: **`pahirango`** (must match your domain path)
3. Double-click `pahirango` to enter it

### 2.3 Upload PHP Files

Inside the `pahirango` folder, upload these 5 files from your computer:

```
From: e:\Assignments\Fourth Sem\Web-Tech-Lab-Record\Ex-8-PHP-Forms\
  ✅ process_contact.php
  ✅ process_ecommerce_forms.php

From: e:\Assignments\Fourth Sem\Web-Tech-Lab-Record\Ex-9-PHP-MySQL\
  ✅ config.php
  ✅ api.php

From: e:\Assignments\Fourth Sem\Web-Tech-Lab-Record\Ex-10-Sessions-Cookies\
  ✅ session_handler.php
```

**How to Upload:**
1. Click **"Upload File"** button
2. Select file from your computer
3. Wait for upload to complete
4. Repeat for all 5 files

**Result:**
```
public_html/
└── pahirango/
    ├── config.php
    ├── api.php
    ├── process_contact.php
    ├── process_ecommerce_forms.php
    └── session_handler.php
```

---

## 🗄️ STEP 3: CREATE MYSQL DATABASE

### 3.1 Go to MySQL Databases

1. From InfinityFree account panel, find **"MySQL Databases"**
2. You'll see a form to create new database

### 3.2 Create Database

1. **Database Name**: `pahirango_db`
2. Click **"Create Database"**
3. Wait for confirmation

### 3.3 Get Database Credentials

After creating, you'll see:
```
Database Name: if0_XXXXX_pahirango_db
Database User: if0_XXXXX_yourname
Database Password: (auto-generated - you must COPY this!)
Host: sql312.infinityfree.com (usually)
```

**⚠️ IMPORTANT: COPY AND SAVE these credentials!**

---

## 📊 STEP 4: IMPORT SQL SCHEMA

### 4.1 Open phpMyAdmin

1. From InfinityFree account panel, find **"phpMyAdmin"**
2. Click to open (new tab)
3. You should see your database listed on left side

### 4.2 Import Database Schema

1. Click on your database name: `if0_XXXXX_pahirango_db`
2. Go to **"Import"** tab at top
3. Click **"Choose File"**
4. Select: `DATABASE_SETUP.sql` from your computer
5. Click **"Go"** button at bottom

**Wait for success message:** ✅ Import has been successfully finished

### 4.3 Verify Tables Created

1. Click on your database name (left panel)
2. You should see tables:
   ```
   ✓ users
   ✓ products
   ✓ orders
   ```
3. Click on `products` table
4. You should see 25+ product rows with data

---

## 🔑 STEP 5: UPDATE config.php WITH CREDENTIALS

### 5.1 Edit config.php

1. Go back to File Manager
2. Navigate to `public_html/pahirango/`
3. Right-click on **`config.php`** → **"Edit"**

### 5.2 Find These Lines

```php
define('DB_HOST', 'sql312.infinityfree.com');
define('DB_USER', 'if0_XXXXX_yourname');
define('DB_PASSWORD', 'YOUR_PASSWORD_HERE');
define('DB_NAME', 'if0_XXXXX_pahirango_db');
```

### 5.3 Replace Values

Use the credentials you got from Step 3:

```php
define('DB_HOST', 'sql312.infinityfree.com');  // Usually this one
define('DB_USER', 'if0_41699781_pahirango');   // Your actual username
define('DB_PASSWORD', 'WG31DY2ttM');           // Your actual password
define('DB_NAME', 'if0_41699781_pahirango_db'); // Your actual database
```

**Example (with real data):**
```php
<?php
define('DB_HOST', 'sql312.infinityfree.com');
define('DB_USER', 'if0_41699781_pahirango');
define('DB_PASSWORD', 'WG31DY2ttM');
define('DB_NAME', 'if0_41699781_pahirango_db');
define('API_BASE_URL', 'http://aaryansah.my-style.in/pahirango/');
// ... rest of file
```

### 5.4 Save Changes

1. Click **"Save"** button
2. File should be updated ✓

---

## ✅ STEP 6: TEST YOUR SETUP

### 6.1 Test API Endpoint

Open in browser:
```
http://aaryansah.my-style.in/pahirango/api.php?action=all
```

**Expected Result:** JSON with list of products
```json
{
  "success": true,
  "products": [
    {
      "id": 1,
      "name": "Black T-Shirt",
      "category": "women",
      "price": "299.99",
      ...
    }
  ]
}
```

**If you get error:** Check your credentials in config.php

### 6.2 Test Contact Form

Open in browser:
```
http://aaryansah.my-style.in/pahirango/contact.html
```

**Expected:** Contact form displays (styled)

**Try submitting:** Check browser console (F12) for response

### 6.3 Test Login Form

Open in browser:
```
http://aaryansah.my-style.in/pahirango/login.html
```

**Try logging in** with test data

### 6.4 Test From GitHub Pages

Your main index.html already has links:
- Click **Exercise 08** box → Opens contact form
- Click **Exercise 09** box → Opens products
- Click **Exercise 10** box → Opens login form

---

## 🐛 TROUBLESHOOTING

### Problem 1: Still Getting 404 Error

**Solution:**
1. Check file was uploaded to **`public_html/pahirango/`** folder
2. Verify folder name is exactly **`pahirango`** (lowercase)
3. Refresh browser (Ctrl+Shift+R)
4. Wait 5 minutes (InfinityFree sometimes needs time to recognize files)

### Problem 2: "Database Connection Failed"

**Solution:**
1. Check credentials in config.php match InfinityFree exactly
2. Verify database was created (check phpMyAdmin)
3. Test in phpMyAdmin directly:
   - Click "test connection" or similar option
4. If still failing, get credentials again from InfinityFree panel

### Problem 3: "Table 'products' doesn't exist"

**Solution:**
1. Go to phpMyAdmin
2. Click on your database
3. Check if `products` table exists
4. If not, re-import `DATABASE_SETUP.sql`

### Problem 4: API Returns Empty or Errors

**Solution:**
1. Open phpMyAdmin
2. Click database → Click `products` table
3. Should show 25+ rows with data
4. If empty, re-run DATABASE_SETUP.sql import

### Problem 5: Forms Submit But Get Errors

**Solution:**
1. Open Browser Console (F12 → Console tab)
2. Look for error messages
3. Check that all PHP files are uploaded
4. Verify paths in fetch() URLs match your domain

---

## 📋 COMPLETE CHECKLIST

Use this to verify everything is done:

### File Upload
- [ ] Created folder: `public_html/pahirango/`
- [ ] Uploaded `config.php`
- [ ] Uploaded `api.php`
- [ ] Uploaded `process_contact.php`
- [ ] Uploaded `process_ecommerce_forms.php`
- [ ] Uploaded `session_handler.php`

### Database Setup
- [ ] Created MySQL database `pahirango_db`
- [ ] Have database credentials saved
- [ ] Opened phpMyAdmin
- [ ] Imported `DATABASE_SETUP.sql`
- [ ] Verified `products` table has 25+ rows

### Configuration
- [ ] Updated config.php with correct DB_USER
- [ ] Updated config.php with correct DB_PASSWORD
- [ ] Updated config.php with correct DB_NAME
- [ ] Saved config.php changes

### Testing
- [ ] API endpoint returns JSON products list
- [ ] Contact form page loads and displays
- [ ] Login form page loads and displays
- [ ] GitHub Pages index.html links work
- [ ] No 404 errors anymore ✓

---

## 🎯 FINAL VERIFICATION

Once everything is done, you should see:

### ✅ Exercise 08 (Contact Form)
```
URL: http://aaryansah.my-style.in/pahirango/contact.html
Features:
- Form displays with your style
- Can fill and submit form
- Success/error messages show
- Data is processed on server
```

### ✅ Exercise 09 (Products from Database)
```
URL: http://aaryansah.my-style.in/pahirango/api.php?action=all
Features:
- JSON response with products
- 25+ products with categories
- All fields populated (name, price, category)
- Images path included
```

### ✅ Exercise 10 (Login & Sessions)
```
URL: http://aaryansah.my-style.in/pahirango/login.html
Features:
- Login form displays
- Can submit credentials
- Session management works
- Shopping cart persists
```

---

## 📞 NEED HELP?

### If InfinityFree doesn't show your files:
1. Wait 5-10 minutes (servers can be slow)
2. Refresh browser with **Ctrl+Shift+R** (hard refresh)
3. Check file permissions (should be 644 for files)
4. Re-upload files if needed

### If Database connection fails:
1. Copy credentials exactly as shown in InfinityFree panel
2. Don't add extra spaces or characters
3. Test each line individually in config.php

### If SQL import fails:
1. Check file size is correct (DATABASE_SETUP.sql should be ~5KB)
2. Try importing step by step (first users table, then products)
3. Check for syntax errors in phpMyAdmin SQL editor

---

## ✨ SUCCESS INDICATORS

You'll know everything works when:
- ✅ No more 404 errors
- ✅ API returns product JSON
- ✅ Forms submit without errors
- ✅ GitHub Pages links work
- ✅ All three exercises functional
- ✅ Ready for faculty submission!

**Estimated Time: 15-20 minutes**

Good luck! 🚀
