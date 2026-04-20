<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex-10 — Sessions, Cookies &amp; Shopping Cart | PahiranGo Lab</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --brand-start: #667eea; --brand-end: #764ba2; --brand-mid: #6f73d2;
            --white: #ffffff; --surface: #f8f7ff; --border: #e8e4f3;
            --text-primary: #1a1525; --text-secondary: #5a5370; --text-muted: #8b85a0;
            --success: #059669; --success-bg: #ecfdf5; --warning: #b45309;
            --warning-bg: #fffbeb; --session-color: #0891b2; --session-bg: #ecfeff;
            --cookie-color: #d97706; --cookie-bg: #fffbeb; --cart-color: #7c3aed;
            --cart-bg: #f5f3ff; --shadow-sm: 0 2px 8px rgba(102,126,234,0.08);
            --shadow-md: 0 8px 32px rgba(102,126,234,0.14); --shadow-lg: 0 20px 60px rgba(102,126,234,0.18);
            --radius: 16px;
        }
        body { font-family: 'DM Sans', sans-serif; background: linear-gradient(135deg, var(--brand-start) 0%, var(--brand-end) 100%); min-height: 100vh; padding: 48px 20px 80px; color: var(--text-primary); }
        body::before { content: ''; position: fixed; inset: 0; background-image: radial-gradient(circle at 10% 40%, rgba(255,255,255,0.07) 0%, transparent 50%), radial-gradient(circle at 90% 60%, rgba(255,255,255,0.05) 0%, transparent 50%); pointer-events: none; z-index: 0; }
        .container { max-width: 960px; margin: 0 auto; position: relative; z-index: 1; }
        .header-card { background: var(--white); border-radius: var(--radius); padding: 40px 44px 36px; box-shadow: var(--shadow-lg); margin-bottom: 28px; position: relative; overflow: hidden; }
        .header-card::after { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--session-color), var(--brand-start), var(--cart-color)); }
        .ex-label { display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, var(--brand-start), var(--brand-end)); color: white; font-size: 12px; font-weight: 600; padding: 5px 14px; border-radius: 100px; margin-bottom: 18px; }
        .header-card h1 { font-size: 28px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px; }
        .header-subtitle { color: var(--text-secondary); font-size: 15px; line-height: 1.6; margin-bottom: 24px; }
        .meta-row { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 24px; }
        .meta-badge { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); border: 1px solid var(--border); color: var(--text-secondary); font-size: 12.5px; padding: 5px 12px; border-radius: 8px; }
        .meta-badge .dot { width: 7px; height: 7px; border-radius: 50%; }
        .meta-badge.session .dot { background: var(--session-color); }
        .meta-badge.cookie .dot { background: var(--cookie-color); }
        .meta-badge.cart .dot { background: var(--cart-color); }
        .env-note { background: var(--warning-bg); border: 1px solid #fed7aa; border-left: 4px solid #f59e0b; border-radius: 12px; padding: 16px 20px; display: flex; align-items: flex-start; gap: 12px; }
        .env-note-text { font-size: 13.5px; color: var(--warning); line-height: 1.65; }
        .step-card { background: var(--white); border-radius: var(--radius); padding: 36px 40px; box-shadow: var(--shadow-md); margin-bottom: 24px; border: 1px solid rgba(255,255,255,0.6); }
        .step-card.session-step { border-top: 3px solid var(--session-color); }
        .step-card.cookie-step { border-top: 3px solid var(--cookie-color); }
        .step-card.cart-step { border-top: 3px solid var(--cart-color); }
        .step-header { display: flex; align-items: flex-start; gap: 18px; margin-bottom: 20px; }
        .step-badge { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; font-weight: 700; flex-shrink: 0; }
        .step-badge.s1 { background: linear-gradient(135deg, #0891b2, #0e7490); }
        .step-badge.s2 { background: linear-gradient(135deg, #d97706, #b45309); }
        .step-badge.s3 { background: linear-gradient(135deg, #7c3aed, #6d28d9); }
        .step-title { font-size: 20px; font-weight: 700; color: var(--text-primary); }
        .desc-box { border-radius: 10px; padding: 18px 20px; margin-bottom: 22px; font-size: 14.5px; color: var(--text-secondary); border: 1px solid; }
        .desc-box.session { background: var(--session-bg); border-color: #a5f3fc; border-left: 4px solid var(--session-color); }
        .desc-box.cookie { background: var(--cookie-bg); border-color: #fde68a; border-left: 4px solid var(--cookie-color); }
        .desc-box.cart { background: var(--cart-bg); border-color: #ddd6fe; border-left: 4px solid var(--cart-color); }
        .session-id-box { background: #0f172a; border-radius: 10px; padding: 14px 18px; margin-bottom: 22px; font-family: 'DM Mono', monospace; font-size: 13px; color: #94a3b8; display: flex; align-items: center; gap: 10px; }
        .session-id-box .sid { color: #7dd3fc; font-weight: 500; }
        .screenshot-label { font-size: 11.5px; font-weight: 600; text-transform: uppercase; color: var(--text-muted); margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
        .screenshot-label::before { content: ''; display: block; height: 1px; width: 24px; background: var(--border); }
        .img-single { border: 1.5px solid var(--border); border-radius: 12px; overflow: hidden; background: var(--surface); }
        .img-single img { width: 100%; height: auto; display: block; }
        .img-caption { padding: 10px 16px; font-size: 12px; color: var(--text-muted); font-style: italic; }
        .sub-step-divider { display: flex; align-items: center; gap: 12px; margin: 20px 0; color: var(--text-muted); font-size: 12px; font-weight: 500; text-transform: uppercase; }
        .sub-step-divider::before, .sub-step-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
        .outcome-strip { display: flex; align-items: center; gap: 10px; background: var(--success-bg); border: 1px solid #a7f3d0; border-radius: 10px; padding: 12px 18px; margin-top: 18px; font-size: 13.5px; color: var(--success); font-weight: 500; }
        .compare-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 22px; }
        .compare-card { border-radius: 10px; padding: 16px 18px; border: 1px solid; }
        .compare-card.ses { background: var(--session-bg); border-color: #a5f3fc; }
        .compare-card.coo { background: var(--cookie-bg); border-color: #fde68a; }
        .footer-nav { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-top: 12px; }
        .back-btn { display: inline-flex; align-items: center; gap: 9px; background: white; color: var(--brand-start); text-decoration: none; font-weight: 600; font-size: 14px; padding: 13px 24px; border-radius: 12px; box-shadow: var(--shadow-md); transition: all 0.25s ease; border: 1.5px solid transparent; }
        .nav-prev { display: inline-flex; align-items: center; gap: 9px; background: rgba(255,255,255,0.18); color: white; text-decoration: none; font-weight: 600; font-size: 14px; padding: 13px 24px; border-radius: 12px; border: 1.5px solid rgba(255,255,255,0.35); }
        .footer-info { color: rgba(255,255,255,0.7); font-size: 12.5px; text-align: center; width: 100%; margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header-card">
        <div class="ex-label">Exercise 10 · Web Technology Lab · PahiranGo</div>
        <h1>Sessions, Cookies <span>&amp; Shopping Cart</span></h1>
        <p class="header-subtitle">PHP server-side session management for user authentication, browser-side cookie persistence for user preferences, and <code>$_SESSION</code> array-based shopping cart state management.</p>

        <div class="meta-row">
            <span class="meta-badge session"><span class="dot"></span> $_SESSION — Server-side state</span>
            <span class="meta-badge cookie"><span class="dot"></span> setcookie() — Client-side persistence</span>
        </div>

        <div class="env-note">
            <div class="env-note-icon">⚙️</div>
            <div class="env-note-text">
                <strong>Environment Note — Why this is a static result page:</strong> PHP Sessions and Cookies require a running PHP server to allocate session storage. This exercise was <strong>successfully executed and verified on a Localhost XAMPP environment</strong>.
            </div>
        </div>
    </div>

    <div class="step-card session-step">
        <div class="step-header">
            <div class="step-badge s1">1</div>
            <div class="step-header-text">
                <div class="step-title">User Authentication via PHP Sessions</div>
            </div>
        </div>
        <div class="desc-box session">
            <p>PHP generates a cryptographically random <strong>Session ID</strong> which is stored as a cookie on the browser, maintaining the authenticated state across pages.</p>
        </div>
        <div class="session-id-box">
            <span><span class="label">Confirmed Session ID →</span> <span class="sid">cssfldcndsb0pcneito280gurk</span></span>
        </div>
        <div class="screenshot-label">Screenshot — Step 1a: Successful login</div>
        <div class="img-single" style="margin-bottom:14px;">
            <img src="screenshots/step1.png" alt="PHP session login">
            <div class="img-caption">Fig 1.0 — Login confirmed. Server returns Session ID.</div>
        </div>
        <div class="sub-step-divider">Step 1b — Session Destruction on Logout</div>
        <div class="screenshot-label">Screenshot — Step 1b: Logout</div>
        <div class="img-single">
            <img src="screenshots/step1.1.png" alt="PHP session logout">
            <div class="img-caption">Fig 1.1 — After clicking Logout, PHP runs <code>session_destroy()</code>.</div>
        </div>
    </div>

    <div class="step-card cookie-step">
        <div class="step-header">
            <div class="step-badge s2">2</div>
            <div class="step-header-text">
                <div class="step-title">User Preference Persistence via Cookies</div>
            </div>
        </div>
        <div class="desc-box cookie">
            <p>Demonstrates PHP's <code>setcookie()</code> function to write a key-value preference directly to the user's browser (e.g., Theme: Dark).</p>
        </div>
        <div class="compare-grid">
            <div class="compare-card ses"><h4>🔒 Session (Server-side)</h4><p style="font-size: 13px; color: var(--text-secondary)">Expires on browser close / timeout. More secure.</p></div>
            <div class="compare-card coo"><h4>🍪 Cookie (Client-side)</h4><p style="font-size: 13px; color: var(--text-secondary)">Persists after browser close. Configurable expiry.</p></div>
        </div>
        <div class="screenshot-label">Screenshot — Step 2a: Cookie preference form</div>
        <div class="img-single" style="margin-bottom:14px;">
            <img src="screenshots/step2.png" alt="Cookie preference form">
        </div>
        <div class="sub-step-divider">Step 2b — Cookie Successfully Written</div>
        <div class="screenshot-label">Screenshot — Step 2b: PHP confirms cookie stored</div>
        <div class="img-single">
            <img src="screenshots/step2.1.png" alt="PHP cookie confirmation">
        </div>
    </div>

    <div class="step-card cart-step">
        <div class="step-header">
            <div class="step-badge s3">3</div>
            <div class="step-header-text">
                <div class="step-title">Shopping Cart State via $_SESSION Arrays</div>
            </div>
        </div>
        <div class="desc-box cart">
            <p>Utilizing the <code>$_SESSION['cart']</code> array to hold complex cart data temporarily without database queries until checkout.</p>
        </div>
        <div class="screenshot-label">Screenshot — Step 3a: Product added to cart</div>
        <div class="img-single" style="margin-bottom:14px;">
            <img src="screenshots/step3.png" alt="Shopping cart session">
            <div class="img-caption">Fig 3.0 — Product added. Cart has 2 items confirmed without database interaction.</div>
        </div>
        <div class="sub-step-divider">Step 3b — Viewing Cart Contents</div>
        <div class="screenshot-label">Screenshot — Step 3b: Cart contents viewed</div>
        <div class="img-single" style="margin-bottom:14px;">
            <img src="screenshots/step3.1.png" alt="Shopping cart view">
            <div class="img-caption">Fig 3.1 — "View Cart" reads the full <code>$_SESSION['cart']</code> array.</div>
        </div>
        <div class="sub-step-divider">Step 3c — Cart Cleared via Session Reset</div>
        <div class="screenshot-label">Screenshot — Step 3c: Cart cleared</div>
        <div class="img-single">
            <img src="screenshots/step3.2.png" alt="Shopping cart cleared">
            <div class="img-caption">Fig 3.2 — Cart cleared. <code>$_SESSION['cart'] = []</code> array reset.</div>
        </div>
        <div class="outcome-strip">Exercise 10 verified successfully. Sessions, Cookies, and Cart arrays working.</div>
    </div>

    <div class="footer-nav">
        <a href="../index.html" class="back-btn">← Back to Dashboard</a>
        <a href="../Ex-9-PHP-MySQL/index.php" class="nav-prev">← Ex-09 MySQL</a>
    </div>
    <div class="footer-info">PahiranGo · Web Technology Lab Record · B.Tech CSE 2nd Year · Exercises 08–10 Complete</div>
</div>
</body>
</html>