<?php
/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 9: PHP & MYSQL API
 * PRODUCT MANAGEMENT REST API
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * Provides API endpoints to fetch products from database
 * Instead of hardcoded HTML, products are dynamically fetched
 * 
 * CONCEPTS COVERED:
 * 1. Prepared statements (prevent SQL injection)
 * 2. CRUD operations (Create, Read, Update, Delete)
 * 3. JSON API responses
 * 4. Error handling
 * 5. Database queries
 * 
 * ENDPOINTS:
 * GET /api.php?action=all          - Get all products
 * GET /api.php?action=category&cat=women - Get products by category
 * GET /api.php?action=search&q=shirt    - Search products
 * POST /api.php (JSON)             - Add new product (admin)
 */

// Include database configuration
require_once 'config.php';

// Enable CORS and set JSON header
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=utf-8');

// Initialize response
$response = [
    'success' => false,
    'data' => [],
    'message' => ''
];

try {
    // Get action from query string
    $action = isset($_GET['action']) ? $_GET['action'] : 'all';
    
    // ═══════════════════════════════════════════════════════════════
    // ACTION: GET ALL PRODUCTS
    // ═══════════════════════════════════════════════════════════════
    
    if ($action === 'all') {
        
        // SQL Query to fetch all products
        // Using LIMIT 20 for pagination demonstration
        $query = "SELECT id, name, category, price, image, description 
                  FROM products 
                  ORDER BY created_at DESC 
                  LIMIT 20";
        
        // Execute query
        $result = $connection->query($query);
        
        if ($result === false) {
            throw new Exception('Database query failed: ' . $connection->error);
        }
        
        // Fetch all results into array
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        
        $response['success'] = true;
        $response['data'] = $products;
        $response['message'] = count($products) . ' products found';
    }
    
    // ═══════════════════════════════════════════════════════════════
    // ACTION: GET PRODUCTS BY CATEGORY
    // ═══════════════════════════════════════════════════════════════
    
    elseif ($action === 'category') {
        
        $category = isset($_GET['cat']) ? trim($_GET['cat']) : '';
        
        if (empty($category)) {
            throw new Exception('Category parameter is required');
        }
        
        // Use prepared statement to prevent SQL injection
        // Prepared statements separate data from SQL code
        $query = "SELECT id, name, category, price, image, description 
                  FROM products 
                  WHERE category = ? 
                  ORDER BY name ASC";
        
        // Create prepared statement
        $stmt = $connection->prepare($query);
        
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $connection->error);
        }
        
        // Bind parameters: 's' = string type
        $stmt->bind_param('s', $category);
        
        // Execute prepared statement
        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }
        
        // Get results
        $result = $stmt->get_result();
        
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        
        $stmt->close();
        
        $response['success'] = true;
        $response['data'] = $products;
        $response['message'] = count($products) . ' products in category "' . $category . '"';
    }
    
    // ═══════════════════════════════════════════════════════════════
    // ACTION: SEARCH PRODUCTS
    // ═══════════════════════════════════════════════════════════════
    
    elseif ($action === 'search') {
        
        $searchTerm = isset($_GET['q']) ? trim($_GET['q']) : '';
        
        if (empty($searchTerm) || strlen($searchTerm) < 2) {
            throw new Exception('Search term must be at least 2 characters');
        }
        
        // Use prepared statement for search
        // LIKE operator allows partial matching
        $searchTerm = '%' . $searchTerm . '%';
        
        $query = "SELECT id, name, category, price, image, description 
                  FROM products 
                  WHERE name LIKE ? OR description LIKE ? 
                  ORDER BY name ASC";
        
        $stmt = $connection->prepare($query);
        
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $connection->error);
        }
        
        // Bind two parameters
        $stmt->bind_param('ss', $searchTerm, $searchTerm);
        
        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        
        $stmt->close();
        
        $response['success'] = true;
        $response['data'] = $products;
        $response['message'] = count($products) . ' products found matching "' . htmlspecialchars($_GET['q']) . '"';
    }
    
    // ═══════════════════════════════════════════════════════════════
    // ACTION: GET SINGLE PRODUCT DETAILS
    // ═══════════════════════════════════════════════════════════════
    
    elseif ($action === 'product') {
        
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($productId <= 0) {
            throw new Exception('Invalid product ID');
        }
        
        $query = "SELECT id, name, category, price, image, description, quantity 
                  FROM products 
                  WHERE id = ?";
        
        $stmt = $connection->prepare($query);
        
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $connection->error);
        }
        
        // Bind integer parameter: 'i' = integer
        $stmt->bind_param('i', $productId);
        
        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }
        
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            throw new Exception('Product not found');
        }
        
        $product = $result->fetch_assoc();
        $stmt->close();
        
        $response['success'] = true;
        $response['data'] = $product;
        $response['message'] = 'Product found';
    }
    
    else {
        throw new Exception('Unknown action: ' . htmlspecialchars($action));
    }
    
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
    // Optionally log detailed errors
    error_log('API Error: ' . $e->getMessage());
}

// Send JSON response
echo json_encode($response, JSON_PRETTY_PRINT);
?>
