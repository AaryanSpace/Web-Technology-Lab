<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 9 - PHP MySQL</title>
    <style>
        body { font-family: 'Segoe UI'; margin: 0; padding: 40px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #667eea; }
        .section { margin-bottom: 30px; padding: 20px; background: #f9f9f9; border-radius: 8px; border-left: 4px solid #667eea; }
        code { background: #e8eaf6; padding: 2px 6px; border-radius: 4px; font-family: monospace; }
        pre { background: #f5f5f5; padding: 15px; overflow-x: auto; border-radius: 8px; border: 1px solid #ddd; }
        ul { line-height: 1.8; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Exercise 9: PHP & MySQL Database Management</h1>
        
        <div class="section">
            <h2>What is MySQL?</h2>
            <p>MySQL is a <strong>Relational Database Management System (RDBMS)</strong> that stores data in structured tables with rows and columns.</p>
            <ul>
                <li><strong>Tables</strong> - Like spreadsheets with rows and columns</li>
                <li><strong>Rows</strong> - Individual records (one product)</li>
                <li><strong>Columns</strong> - Fields/properties (name, price, category)</li>
                <li><strong>Queries</strong> - Commands to retrieve or modify data</li>
            </ul>
        </div>
        
        <div class="section">
            <h2>SQL Commands (Create, Read, Update, Delete)</h2>
            
            <h3>1. CREATE - Insert new product</h3>
            <pre>INSERT INTO products (name, category, price) 
VALUES ('Summer Dress', 'women', 49.99)</pre>
            
            <h3>2. READ - Retrieve products</h3>
            <pre>SELECT * FROM products WHERE category = 'women'</pre>
            
            <h3>3. UPDATE - Modify product</h3>
            <pre>UPDATE products SET price = 39.99 WHERE id = 1</pre>
            
            <h3>4. DELETE - Remove product</h3>
            <pre>DELETE FROM products WHERE id = 1</pre>
        </div>
        
        <div class="section">
            <h2>PHP MySQLi Connection</h2>
            <pre><?php echo htmlspecialchars('
$connection = new mysqli(
    "localhost",      // Host
    "root",           // Username
    "",               // Password
    "pahirango_shop"  // Database name
);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
'); ?></pre>
        </div>
        
        <div class="section">
            <h2>Prepared Statements for Security</h2>
            <p><strong>Why use prepared statements?</strong> They prevent SQL injection attacks!</p>
            
            <h3>Unsafe (NEVER DO THIS):</h3>
            <pre><?php echo htmlspecialchars(
'$query = "SELECT * FROM products WHERE id = " . $id;
$result = $connection->query($query);'
            ); ?></pre>
            
            <h3>Safe (ALWAYS DO THIS):</h3>
            <pre><?php echo htmlspecialchars(
'$query = "SELECT * FROM products WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $id);  // "i" = integer
$stmt->execute();
$result = $stmt->get_result();'
            ); ?></pre>
        </div>
        
        <div class="section">
            <h2>File Structure</h2>
            <pre>
Ex-9-PHP-MySQL/
├── config.php          Database connection
├── products.php        CRUD functions
├── api.php            API endpoints
└── README.md          Documentation
            </pre>
        </div>
        
        <div class="section">
            <h2>Key Functions</h2>
            <ul>
                <li><code>getAllProducts()</code> - Fetch all products</li>
                <li><code>getProductById($id)</code> - Fetch single product</li>
                <li><code>getProductsByCategory($cat)</code> - Filter by category</li>
                <li><code>addProduct(...)</code> - Insert new product</li>
                <li><code>updateProduct(...)</code> - Modify product</li>
                <li><code>deleteProduct($id)</code> - Remove product</li>
                <li><code>searchProducts($keyword)</code> - Search functionality</li>
            </ul>
        </div>
        
        <div class="section">
            <h2>Database Setup Instructions</h2>
            <ol>
                <li>Open phpMyAdmin or MySQL command line</li>
                <li>Create database: <code>CREATE DATABASE pahirango_shop;</code></li>
                <li>Use database: <code>USE pahirango_shop;</code></li>
                <li>Create products table (see sql schema in products.php)</li>
                <li>Insert sample products</li>
                <li>Run API endpoints to test</li>
            </ol>
            
            <h3>Sample Insert:</h3>
            <pre>INSERT INTO products (name, category, price, description, stock_quantity) 
VALUES 
('Summer Dress', 'women', 49.99, 'Beautiful summer dress', 15),
('Casual Tshirt', 'men', 29.99, 'Comfortable shirt', 20),
('Lipstick Set', 'cosmetics', 39.99, 'Premium lipsticks', 10);</pre>
        </div>
        
        <div class="section" style="border-left-color: #10b981;">
            <h2>✓ Next: Exercise 10 - Sessions and Cookies</h2>
            <p>Learn how to store user information across multiple pages and persist login states!</p>
        </div>
    </div>
</body>
</html>
