<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 10 - Sessions & Cookies Demo</title>
    <style>
        body { font-family: 'Segoe UI'; margin: 0; padding: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        h1, h2 { color: #667eea; }
        section { margin-bottom: 30px; padding: 20px; background: #f9f9f9; border-radius: 8px; border-left: 4px solid #667eea; }
        button { padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px; }
        button:hover { background: #764ba2; }
        input { padding: 8px; margin-right: 10px; border: 1px solid #ddd; border- radius: 5px; }
        code { background: #e8eaf6; padding: 2px 6px; border-radius: 4px; }
        pre { background: #f5f5f5; padding: 15px; overflow-x: auto; border-radius: 5px; border: 1px solid #ddd; }
        .success { color: #10b981; }
        .error { color: #dc2626; }
        ul { line-height: 1.8; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Exercise 10: Sessions & Cookies Management</h1>
        
        <section>
            <h2>🔐 User Authentication (Sessions)</h2>
            <p><strong>Sessions:</strong> Store user data on the server, accessible across pages</p>
            
            <div>
                <input type="email" id="email" placeholder="Email" value="user@pahirango.com">
                <input type="password" id="password" placeholder="Password" value="Pass@123">
                <button onclick="login()">Login</button>
                <button onclick="logout()">Logout</button>
                <button onclick="checkSession()">Check Session</button>
            </div>
            
            <div id="sessionInfo" style="margin-top: 15px; padding: 15px; background: white; border-radius: 5px;"></div>
        </section>
        
        <section>
            <h2>🍪 Persistent Storage (Cookies)</h2>
            <p><strong>Cookies:</strong> Store user preferences on the browser, persist even after closing tab</p>
            
            <div>
                <label>Preference Key: <input type="text" id="prefKey" placeholder="e.g., theme"></label>
                <label>Value: <input type="text" id="prefValue" placeholder="e.g., dark"></label>
                <button onclick="storePreference()">Store</button>
                <button onclick="getPreferences()">View Preferences</button>
            </div>
            
            <div id="preferencesInfo" style="margin-top: 15px; padding: 15px; background: white; border-radius: 5px;"></div>
        </section>
        
        <section>
            <h2>🛒 Shopping Cart (Session Persistence)</h2>
            <p><strong>Use Case:</strong> Keep shopping cart data across multiple pages</p>
            
            <div>
                <label>Product ID: <input type="number" id="productId" placeholder="1" value="1"></label>
                <label>Quantity: <input type="number" id="quantity" placeholder="1" value="1"></label>
                <button onclick="addToCart()">Add to Cart</button>
                <button onclick="viewCart()">View Cart</button>
                <button onclick="clearCart()">Clear Cart</button>
            </div>
            
            <div id="cartInfo" style="margin-top: 15px; padding: 15px; background: white; border-radius: 5px;"></div>
        </section>
        
        <section style="border-left-color: #764ba2;">
            <h2>📚 Key Concepts</h2>
            
            <h3>Difference Between Sessions and Cookies:</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr style="background: #f0f0f0;">
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Feature</th>
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Session</th>
                    <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Cookie</th>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;"><strong>Storage Location</strong></td>
                    <td style="border: 1px solid #ddd; padding: 10px;">Server</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">Browser (Client)</td>
                </tr>
                <tr style="background: #f9f9f9;">
                    <td style="border: 1px solid #ddd; padding: 10px;"><strong>Persistence</strong></td>
                    <td style="border: 1px solid #ddd; padding: 10px;">Destroyed when browser closes</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">Persists for specified duration</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 10px;"><strong>Security</strong></td>
                    <td style="border: 1px solid #ddd; padding: 10px;">More secure (server-side)</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">Less secure (can be modified)</td>
                </tr>
                <tr style="background: #f9f9f9;">
                    <td style="border: 1px solid #ddd; padding: 10px;"><strong>Best For</strong></td>
                    <td style="border: 1px solid #ddd; padding: 10px;">Authentication, sensitive data</td>
                    <td style="border: 1px solid #ddd; padding: 10px;">Preferences, remembering choices</td>
                </tr>
            </table>
            
            <h3 style="margin-top: 20px;">Session Flow:</h3>
            <pre>1. User logs in → PHP creates SID (Session ID)
2. SID stored in PHPSESSID cookie on browser
3. When user requests another page, browser sends PHPSESSID
4. PHP uses SID to retrieve $_SESSION data
5. User data accessible throughout session</pre>
            
            <h3>Cookie Example:</h3>
            <pre>setcookie(
    'userName',           // Cookie name
    'John',               // Cookie value
    time() + (86400*7),   // Expires in 7 days
    '/'                   // Available from root
);</pre>
        </section>
        
        <section style="border-left-color: #10b981;">
            <h2>✓ Congratulations!</h2>
            <p>You've completed all 10 exercises! You now understand:</p>
            <ul>
                <li>✓ HTML basics and structure</li>
                <li>✓ CSS styling and layouts</li>
                <li>✓ JavaScript events and DOM manipulation</li>
                <li>✓ Form validation (client-side)</li>
                <li>✓ PHP form processing (server-side)</li>
                <li>✓ MySQL databases and queries</li>
                <li>✓ Sessions and Cookies for state management</li>
            </ul>
            <p>Next Steps: Learn frameworks like Laravel, Node.js, or React!</p>
        </section>
    </div>
    
    <script>
        function makeRequest(action, data = {}) {
            data.action = action;
            return fetch('session_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(data)
            })
            .then(r => r.json());
        }
        
        function login() {
            makeRequest('login', {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            }).then(r => {
                document.getElementById('sessionInfo').innerHTML = 
                    '<div class="' + (r.success ? 'success' : 'error') + '">' + r.message + '</div>';
                if (r.success) checkSession();
            });
        }
        
        function logout() {
            makeRequest('logout').then(r => {
                document.getElementById('sessionInfo').innerHTML = 
                    '<div class="success">' + r.message + '</div>';
            });
        }
        
        function checkSession() {
            makeRequest('getSession').then(r => {
                if (r.authenticated) {
                    document.getElementById('sessionInfo').innerHTML = 
                        '<div class="success">✓ Logged in as: ' + r.email + '<br>Session ID: ' + r.sessionId + '</div>';
                } else {
                    document.getElementById('sessionInfo').innerHTML = 
                        '<div class="error">✗ Not authenticated</div>';
                }
            });
        }
        
        function storePreference() {
            makeRequest('storePreference', {
                key: document.getElementById('prefKey').value,
                value: document.getElementById('prefValue').value
            }).then(r => {
                document.getElementById('preferencesInfo').innerHTML = 
                    '<div class="success">' + r.message + '</div>';
            });
        }
        
        function getPreferences() {
            makeRequest('getPreferences').then(r => {
                let html = '<strong>Stored Preferences:</strong><br>';
                if (Object.keys(r.preferences).length === 0) {
                    html += '<em>No preferences stored</em>';
                } else {
                    for (let key in r.preferences) {
                        html += key + ': ' + r.preferences[key] + '<br>';
                    }
                }
                document.getElementById('preferencesInfo').innerHTML = html;
            });
        }
        
        function addToCart() {
            makeRequest('addToCart', {
                productId: document.getElementById('productId').value,
                quantity: document.getElementById('quantity').value
            }).then(r => {
                if (r.success) {
                    document.getElementById('cartInfo').innerHTML = 
                        '<div class="success">Product added! Cart has ' + r.cartItems + ' items</div>';
                }
            });
        }
        
        function viewCart() {
            makeRequest('getCart').then(r => {
                let html = '<strong>Shopping Cart:</strong> (' + r.totalItems + ' items)<br>';
                if (r.totalItems === 0) {
                    html = '<em>Cart is empty</em>';
                } else {
                    html += '<ul>';
                    for (let id in r.cart) {
                        html += '<li>Product ' + r.cart[id].productId + ': Qty ' + r.cart[id].quantity + '</li>';
                    }
                    html += '</ul>';
                }
                document.getElementById('cartInfo').innerHTML = html;
            });
        }
        
        function clearCart() {
            makeRequest('clearCart').then(r => {
                document.getElementById('cartInfo').innerHTML = 
                    '<div class="success">' + r.message + '</div>';
            });
        }
    </script>
</body>
</html>
