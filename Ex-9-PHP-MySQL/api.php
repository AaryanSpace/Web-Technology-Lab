<?php
/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 9: API ENDPOINT FOR PRODUCTS
 * ═══════════════════════════════════════════════════════════════
 */

header('Content-Type: application/json');

require_once 'config.php';
require_once 'products.php';

$response = ['success' => false, 'data' => [], 'message' => ''];

// Get action from request
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    
    // GET ALL PRODUCTS
    case 'getAll':
        $products = getAllProducts();
        $response['success'] = true;
        $response['data'] = $products;
        $response['message'] = 'Retrieved ' . count($products) . ' products';
        break;
    
    // GET SINGLE PRODUCT
    case 'getById':
        if (isset($_GET['id'])) {
            $product = getProductById($_GET['id']);
            if ($product) {
                $response['success'] = true;
                $response['data'] = $product;
            } else {
                $response['message'] = 'Product not found';
            }
        }
        break;
    
    // GET PRODUCTS BY CATEGORY
    case 'getByCategory':
        if (isset($_GET['category'])) {
            $products = getProductsByCategory($_GET['category']);
            $response['success'] = true;
            $response['data'] = $products;
            $response['message'] = 'Retrieved products in category ' . $_GET['category'];
        }
        break;
    
    // SEARCH PRODUCTS
    case 'search':
        if (isset($_GET['keyword'])) {
            $products = searchProducts($_GET['keyword']);
            $response['success'] = true;
            $response['data'] = $products;
            $response['message'] = 'Search results for "' . $_GET['keyword'] . '"';
        }
        break;
    
    // ADD PRODUCT
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $category = isset($_POST['category']) ? $_POST['category'] : '';
            $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
            
            if (addProduct($name, $category, $price, $description, $stock)) {
                $response['success'] = true;
                $response['message'] = 'Product added successfully';
            } else {
                $response['message'] = 'Failed to add product';
            }
        }
        break;
    
    default:
        $response['message'] = 'Invalid action';
}

echo json_encode($response);
?>