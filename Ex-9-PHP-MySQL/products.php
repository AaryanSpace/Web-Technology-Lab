<?php
/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 9: PRODUCT MANAGEMENT OPERATIONS
 * ═══════════════════════════════════════════════════════════════
 * 
 * SQL QUERIES FOR PRODUCTS MANAGEMENT
 */

// Include database configuration
require_once 'config.php';

// ═══════════════════════════════════════════════════════════════
// DATABASE SCHEMA (SQL COMMANDS TO CREATE TABLES)
// ═══════════════════════════════════════════════════════════════

/**
 * PRODUCTS TABLE STRUCTURE
 * 
 * Create this table by running this SQL in MySQL:
 * 
 * CREATE TABLE products (
 *     id INT PRIMARY KEY AUTO_INCREMENT,
 *     name VARCHAR(100) NOT NULL,
 *     category VARCHAR(50) NOT NULL,
 *     price DECIMAL(10, 2) NOT NULL,
 *     description TEXT,
 *     image_url VARCHAR(255),
 *     stock_quantity INT DEFAULT 0,
 *     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 *     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
 * );
 */

// ═══════════════════════════════════════════════════════════════
// FUNCTIONS FOR PRODUCT MANAGEMENT
// ═══════════════════════════════════════════════════════════════

/**
 * getAllProducts()
 * 
 * Retrieves all products from database
 * 
 * RETURNS: Array of products
 */
function getAllProducts() {
    global $connection;
    
    // SQL query to select all products
    // SELECT * means "get all columns"
    // FROM products means "from products table"
    $query = "SELECT * FROM products ORDER BY id DESC";
    
    // Execute query
    $result = $connection->query($query);
    
    // Check if query was successful
    if (!$result) {
        // If error, return empty array
        return [];
    }
    
    // Fetch all results as associative arrays
    // fetch_all() returns all rows at once
    $products = $result->fetch_all(MYSQLI_ASSOC);
    
    return $products;
}

/**
 * getProductById($id)
 * 
 * Retrieves a single product by ID
 * Uses prepared statements for security
 * 
 * PARAMETERS:
 * - $id: Product ID
 * 
 * RETURNS: Product array or null
 */
function getProductById($id) {
    global $connection;
    
    // Prepared statement to prevent SQL injection
    // ? is a placeholder for the parameter
    $query = "SELECT * FROM products WHERE id = ?";
    
    // Prepare statement
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        return null;
    }
    
    // Bind parameter: "i" means integer type
    $stmt->bind_param("i", $id);
    
    // Execute prepared statement
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    return $product;
}

/**
 * getProductsByCategory($category)
 * 
 * Retrieves products filtered by category
 * 
 * PARAMETERS:
 * - $category: Product category
 * 
 * RETURNS: Array of products
 */
function getProductsByCategory($category) {
    global $connection;
    
    // Prepared statement with category filter
    $query = "SELECT * FROM products WHERE category = ? ORDER BY id DESC";
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        return [];
    }
    
    // Bind parameter: "s" means string type
    $stmt->bind_param("s", $category);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    
    return $products;
}

/**
 * addProduct($name, $category, $price, $description, $stock)
 * 
 * Adds new product to database
 * Uses prepared statements for security
 * 
 * PARAMETERS:
 * - $name: Product name
 * - $category: Product category
 * - $price: Product price
 * - $description: Product description
 * - $stock: Stock quantity
 * 
 * RETURNS: true if successful, false otherwise
 */
function addProduct($name, $category, $price, $description, $stock) {
    global $connection;
    
    // INSERT query to add new product
    $query = "INSERT INTO products (name, category, price, description, stock_quantity) 
              VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        return false;
    }
    
    // Bind parameters: "ssdsi" means string, string, decimal (stored as float), string, integer
    $stmt->bind_param("ssdsi", $name, $category, $price, $description, $stock);
    
    // Execute and return success status
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

/**
 * updateProduct($id, $name, $category, $price, $description, $stock)
 * 
 * Updates existing product in database
 * 
 * PARAMETERS:
 * - $id: Product ID
 * - $name: Product name
 * - $category: Product category
 * - $price: Product price
 * - $description: Product description
 * - $stock: Stock quantity
 * 
 * RETURNS: true if successful
 */
function updateProduct($id, $name, $category, $price, $description, $stock) {
    global $connection;
    
    // UPDATE query to modify existing product
    $query = "UPDATE products SET name=?, category=?, price=?, description=?, stock_quantity=? 
              WHERE id=?";
    
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        return false;
    }
    
    // Bind parameters
    $stmt->bind_param("ssdsii", $name, $category, $price, $description, $stock, $id);
    
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

/**
 * deleteProduct($id)
 * 
 * Deletes product from database
 * 
 * PARAMETERS:
 * - $id: Product ID to delete
 * 
 * RETURNS: true if successful
 */
function deleteProduct($id) {
    global $connection;
    
    // DELETE query
    $query = "DELETE FROM products WHERE id = ?";
    
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        return false;
    }
    
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

/**
 * searchProducts($keyword)
 * 
 * Searches products by name or description
 * 
 * PARAMETERS:
 * - $keyword: Search keyword
 * 
 * RETURNS: Array of matching products
 */
function searchProducts($keyword) {
    global $connection;
    
    // LIKE operator for pattern matching
    // % means "any characters"
    // So "%keyword%" means "keyword anywhere in the text"
    $query = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ? ORDER BY id DESC";
    
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        return [];
    }
    
    // Add wildcards for pattern matching
    $searchTerm = "%" . $keyword . "%";
    
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    
    return $products;
}

/**
 * IMPORTANT: Prepared Statements
 * 
 * Always use prepared statements:
 * ✓ SECURE: Prevents SQL injection attacks
 * ✓ EFFICIENT: Can be reused with different parameters
 * ✓ SAFE: Separates SQL code from user data
 * 
 * Never do this (UNSAFE):
 * $query = "SELECT * FROM products WHERE id = " . $id;
 * 
 * Always do this (SAFE):
 * $query = "SELECT * FROM products WHERE id = ?";
 * $stmt->bind_param("i", $id);
 */
?>