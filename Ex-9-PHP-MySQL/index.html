<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex-09 — PHP MySQL Integration | PahiranGo Lab</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --brand-start: #667eea; --brand-end: #764ba2; --brand-mid: #6f73d2;
            --white: #ffffff; --surface: #f8f7ff; --border: #e8e4f3;
            --text-primary: #1a1525; --text-secondary: #5a5370; --text-muted: #8b85a0;
            --success: #059669; --success-bg: #ecfdf5; --warning: #b45309;
            --warning-bg: #fffbeb; --mysql-color: #e8660a; --mysql-bg: #fff7ed;
            --code-bg: #f1eeff; --shadow-sm: 0 2px 8px rgba(102,126,234,0.08);
            --shadow-md: 0 8px 32px rgba(102,126,234,0.14); --shadow-lg: 0 20px 60px rgba(102,126,234,0.18);
            --radius: 16px;
        }
        body { font-family: 'DM Sans', sans-serif; background: linear-gradient(135deg, var(--brand-start) 0%, var(--brand-end) 100%); min-height: 100vh; padding: 48px 20px 80px; color: var(--text-primary); }
        body::before { content: ''; position: fixed; inset: 0; background-image: radial-gradient(circle at 15% 30%, rgba(255,255,255,0.07) 0%, transparent 50%), radial-gradient(circle at 85% 70%, rgba(255,255,255,0.05) 0%, transparent 50%); pointer-events: none; z-index: 0; }
        .container { max-width: 960px; margin: 0 auto; position: relative; z-index: 1; }
        .header-card { background: var(--white); border-radius: var(--radius); padding: 40px 44px 36px; box-shadow: var(--shadow-lg); margin-bottom: 28px; position: relative; overflow: hidden; }
        .header-card::after { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--brand-start), var(--mysql-color), var(--brand-end)); }
        .ex-label { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--brand-start), var(--brand-end)); color: white; font-size: 12px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; padding: 5px 14px; border-radius: 100px; margin-bottom: 18px; }
        .header-card h1 { font-size: 28px; font-weight: 700; color: var(--text-primary); line-height: 1.25; margin-bottom: 8px; }
        .header-card h1 span { background: linear-gradient(135deg, var(--brand-start), var(--brand-end)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .header-subtitle { color: var(--text-secondary); font-size: 15px; line-height: 1.6; margin-bottom: 24px; }
        .meta-row { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 24px; }
        .meta-badge { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); border: 1px solid var(--border); color: var(--text-secondary); font-size: 12.5px; font-weight: 500; padding: 5px 12px; border-radius: 8px; }
        .meta-badge .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--brand-start); }
        .meta-badge.mysql .dot { background: var(--mysql-color); }
        .env-note { background: var(--warning-bg); border: 1px solid #fed7aa; border-left: 4px solid #f59e0b; border-radius: 12px; padding: 16px 20px; display: flex; align-items: flex-start; gap: 12px; }
        .env-note-icon { font-size: 20px; flex-shrink: 0; margin-top: 1px; }
        .env-note-text { font-size: 13.5px; color: var(--warning); line-height: 1.65; }
        .step-card { background: var(--white); border-radius: var(--radius); padding: 36px 40px; box-shadow: var(--shadow-md); margin-bottom: 24px; border: 1px solid rgba(255,255,255,0.6); }
        .step-header { display: flex; align-items: flex-start; gap: 18px; margin-bottom: 20px; }
        .step-badge { width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, var(--brand-start), var(--brand-end)); display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; font-weight: 700; flex-shrink: 0; }
        .step-title { font-size: 20px; font-weight: 700; color: var(--text-primary); margin-bottom: 4px; }
        .desc-box { background: var(--surface); border: 1px solid var(--border); border-left: 4px solid var(--brand-start); border-radius: 10px; padding: 18px 20px; margin-bottom: 22px; font-size: 14.5px; color: var(--text-secondary); line-height: 1.75; }
        .schema-table { width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 22px; border-radius: 10px; overflow: hidden; border: 1px solid var(--border); }
        .schema-table th { background: var(--code-bg); color: var(--brand-mid); font-weight: 600; font-size: 11.5px; text-transform: uppercase; padding: 10px 14px; text-align: left; }
        .schema-table td { padding: 9px 14px; color: var(--text-secondary); border-bottom: 1px solid var(--border); }
        .mysql-info { background: var(--mysql-bg); border: 1px solid #fed7aa; border-left: 4px solid var(--mysql-color); border-radius: 10px; padding: 14px 18px; font-size: 13.5px; color: #9a3412; margin-bottom: 22px; line-height: 1.65; }
        .screenshot-label { font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.09em; color: var(--text-muted); margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
        .screenshot-label::before { content: ''; display: block; height: 1px; width: 24px; background: var(--border); }
        .img-single { border: 1.5px solid var(--border); border-radius: 12px; overflow: hidden; background: var(--surface); box-shadow: var(--shadow-sm); }
        .img-single img { width: 100%; height: auto; display: block; }
        .img-caption { padding: 10px 16px; font-size: 12px; color: var(--text-muted); background: var(--surface); border-top: 1px solid var(--border); font-style: italic; }
        .sub-step-divider { display: flex; align-items: center; gap: 12px; margin: 20px 0; color: var(--text-muted); font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.07em; }
        .sub-step-divider::before, .sub-step-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
        .outcome-strip { display: flex; align-items: center; gap: 10px; background: var(--success-bg); border: 1px solid #a7f3d0; border-radius: 10px; padding: 12px 18px; margin-top: 18px; font-size: 13.5px; color: var(--success); font-weight: 500; }
        .outcome-strip::before { content: '✓'; font-weight: 700; font-size: 15px; }
        .footer-nav { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-top: 12px; }
        .back-btn { display: inline-flex; align-items: center; gap: 9px; background: white; color: var(--brand-start); text-decoration: none; font-weight: 600; font-size: 14px; padding: 13px 24px; border-radius: 12px; box-shadow: var(--shadow-md); transition: all 0.25s ease; border: 1.5px solid transparent; }
        .back-btn:hover { background: var(--brand-start); color: white; transform: translateY(-2px); box-shadow: var(--shadow-lg); }
        .nav-next { display: inline-flex; align-items: center; gap: 9px; background: rgba(255,255,255,0.18); color: white; text-decoration: none; font-weight: 600; font-size: 14px; padding: 13px 24px; border-radius: 12px; border: 1.5px solid rgba(255,255,255,0.35); }
        .footer-info { color: rgba(255,255,255,0.7); font-size: 12.5px; text-align: center; width: 100%; margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header-card">
        <div class="ex-label">Exercise 09 · Web Technology Lab · PahiranGo</div>
        <h1>Product Management <span>with MySQL Database</span></h1>
        <p class="header-subtitle">Designing the pahirango_db schema in phpMyAdmin, populating product records across categories, and dynamically rendering the PahiranGo storefront from the database using PHP prepared statements.</p>

        <div class="meta-row">
            <span class="meta-badge"><span class="dot"></span> Language: PHP 8.x + MySQL</span>
            <span class="meta-badge mysql"><span class="dot"></span> Database: pahirango_db</span>
            <span class="meta-badge"><span class="dot"></span> Tool: phpMyAdmin (localhost)</span>
        </div>

        <div class="env-note">
            <div class="env-note-icon">⚙️</div>
            <div class="env-note-text">
                <strong>Environment Note — Why this is a static result page:</strong> This module requires a running MySQL server and PHP backend to establish a live database connection. GitHub Pages serves only static files — it cannot execute PHP or query a database. This exercise was <strong>successfully executed and verified on a Localhost XAMPP environment</strong>. 
            </div>
        </div>
    </div>

    <div class="step-card">
        <div class="step-header">
            <div class="step-badge">1</div>
            <div class="step-header-text">
                <div class="step-title">Database Schema Creation in phpMyAdmin</div>
            </div>
        </div>
        <div class="desc-box">
            <p>The database <strong>pahirango_db</strong> was created inside XAMPP's MySQL server via phpMyAdmin. The core <code>products</code> table was designed to store all product information needed by the PahiranGo storefront.</p>
        </div>
        <table class="schema-table">
            <thead>
                <tr><th>#</th><th>Column Name</th><th>Data Type</th><th>Null</th><th>Role</th></tr>
            </thead>
            <tbody>
                <tr><td>1</td><td><code>id</code></td><td><code>int(11)</code></td><td>No</td><td>Unique product identifier (PK)</td></tr>
                <tr><td>2</td><td><code>name</code></td><td><code>varchar(150)</code></td><td>No</td><td>Product display name</td></tr>
                <tr><td>3</td><td><code>category</code></td><td><code>varchar(50)</code></td><td>No</td><td>women / men / cosmetics</td></tr>
                <tr><td>4</td><td><code>price</code></td><td><code>decimal(10,2)</code></td><td>No</td><td>Price in INR</td></tr>
                <tr><td>5</td><td><code>quantity</code></td><td><code>int(11)</code></td><td>Yes</td><td>Stock count</td></tr>
            </tbody>
        </table>
        <div class="screenshot-label">Screenshot — Step 1: phpMyAdmin table structure</div>
        <div class="img-single">
            <img src="screenshots/step1.png" alt="phpMyAdmin showing products table structure">
            <div class="img-caption">Fig 1.0 — phpMyAdmin Structure tab showing the completed products table.</div>
        </div>
    </div>

    <div class="step-card">
        <div class="step-header">
            <div class="step-badge">2</div>
            <div class="step-header-text">
                <div class="step-title">Data Insertion &amp; Persistence</div>
            </div>
        </div>
        <div class="mysql-info">
            <strong>📊 Data Summary:</strong> 21 total records — 9 Women's products, 6 Men's products, 6 Cosmetics products. Price range: ₹250 – ₹8,000.
        </div>
        <div class="screenshot-label">Screenshot — Step 2: phpMyAdmin Browse view showing records</div>
        <div class="img-single">
            <img src="screenshots/step2.png" alt="phpMyAdmin browse view showing all product records">
            <div class="img-caption">Fig 2.0 — phpMyAdmin Browse tab confirming all 21 product rows stored.</div>
        </div>
    </div>

    <div class="step-card">
        <div class="step-header">
            <div class="step-badge">3</div>
            <div class="step-header-text">
                <div class="step-title">Dynamic E-Commerce Storefront</div>
            </div>
        </div>
        <div class="desc-box">
            <p>The PHP script connects to MySQL using PDO and executes a <strong>prepared statement</strong> (<code>SELECT * FROM products</code>) to fetch products, which are then iterated through a loop to dynamically generate HTML product cards.</p>
        </div>
        <div class="screenshot-label">Screenshot — Step 3a: PahiranGo storefront rendered from MySQL</div>
        <div class="img-single" style="margin-bottom: 14px;">
            <img src="screenshots/step3.png" alt="PahiranGo storefront dynamically fetched from MySQL">
            <div class="img-caption">Fig 3.0 — PahiranGo homepage showing dynamically generated product cards.</div>
        </div>
        <div class="sub-step-divider">Step 3b — Full Product Grid View</div>
        <div class="screenshot-label">Screenshot — Step 3b: Extended product grid</div>
        <div class="img-single">
            <img src="screenshots/step3.1.png" alt="Full PahiranGo product grid">
            <div class="img-caption">Fig 3.1 — Scrolled view showing multiple rows of products fetched from MySQL.</div>
        </div>
        <div class="outcome-strip">Exercise 09 verified successfully — products successfully fetched and rendered.</div>
    </div>

    <div class="footer-nav">
        <a href="../index.html" class="back-btn">← Back to Dashboard</a>
        <a href="../Ex-10-Sessions-Cookies/index.php" class="nav-next">Next: Ex-10 Sessions →</a>
    </div>
    <div class="footer-info">PahiranGo · Web Technology Lab Record · B.Tech CSE 2nd Year</div>
</div>
</body>
</html>