/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 9: PAHIRANGO E-COMMERCE DATABASE SETUP
 * COMPLETE SQL SCHEMA WITH SAMPLE DATA
 * ═══════════════════════════════════════════════════════════════
 * 
 * HOW TO USE:
 * 1. Login to your InfinityFree hosting control panel
 * 2. Go to MySQL Database Manager (PhpMyAdmin)
 * 3. Select your database "pahirango_db"
 * 4. Click the SQL tab
 * 5. Copy and paste the entire content of this file
 * 6. Click "Go" to execute all queries
 * 
 * This will create the products table with sample data
 */

-- ═══════════════════════════════════════════════════════════════
-- STEP 1: CREATE USERS TABLE (Optional, for future authentication)
-- ═══════════════════════════════════════════════════════════════

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    address TEXT,
    city VARCHAR(50),
    postal_code VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ═══════════════════════════════════════════════════════════════
-- STEP 2: CREATE PRODUCTS TABLE
-- ═══════════════════════════════════════════════════════════════

CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    quantity INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Create index for faster category searches
    INDEX idx_category (category)
);

-- ═══════════════════════════════════════════════════════════════
-- STEP 3: CREATE ORDERS TABLE (Optional, for future checkout)
-- ═══════════════════════════════════════════════════════════════

CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    total_price DECIMAL(10, 2),
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- ═══════════════════════════════════════════════════════════════
-- STEP 4: INSERT SAMPLE PRODUCTS
-- ═══════════════════════════════════════════════════════════════

-- WOMEN'S PRODUCTS
INSERT INTO products (name, category, price, description, image, quantity) VALUES
('Blue Silk Saree', 'women', 2500.00, 'Elegant blue silk saree with golden border', 'women-1.jpg', 15),
('Red Cotton Kurta', 'women', 1200.00, 'Comfortable red cotton kurta for casual wear', 'women-2.jpg', 22),
('White Embroidered Dupatta', 'women', 800.00, 'Handcrafted white dupatta with embroidery', 'women-3.jpg', 18),
('Green Traditional Lehenga', 'women', 3500.00, 'Green traditional lehenga with matching choli', 'women-4.jpg', 10),
('Yellow Party Dress', 'women', 1800.00, 'Yellow party dress for special occasions', 'women-5.jpg', 12),
('Purple Formal Saree', 'women', 2200.00, 'Purple formal saree with temple border', 'women-6.jpg', 8);

-- MEN'S PRODUCTS
INSERT INTO products (name, category, price, description, image, quantity) VALUES
('Black Formal Shirt', 'men', 1500.00, 'Premium black formal shirt for office wear', 'men-1.jpg', 25),
('Blue Denim Jeans', 'men', 1800.00, 'Comfortable blue denim jeans for casual wear', 'men-2.jpg', 30),
('White T-Shirt', 'men', 600.00, 'Basic white cotton t-shirt for everyday wear', 'men-3.jpg', 50),
('Grey Blazer', 'men', 4500.00, 'Premium grey blazer for formal occasions', 'men-4.jpg', 12),
('Black Formal Trousers', 'men', 2200.00, 'Black formal trousers with perfect fit', 'men-5.jpg', 18),
('Casual Polo Shirt', 'men', 900.00, 'Casual polo shirt in various colors', 'men-6.jpg', 35);

-- COSMETICS PRODUCTS
INSERT INTO products (name, category, price, description, image, quantity) VALUES
('Red Lipstick', 'cosmetics', 450.00, 'Matte red lipstick for bold looks', 'cosmetics-1.jpg', 40),
('Foundation Cream', 'cosmetics', 800.00, 'Long-lasting foundation cream for all skin types', 'cosmetics-2.jpg', 25),
('Eye Shadow Palette', 'cosmetics', 1200.00, '12-color eye shadow palette with rich pigments', 'cosmetics-3.jpg', 15),
('Mascara Black', 'cosmetics', 350.00, 'Waterproof black mascara for dramatic lashes', 'cosmetics-4.jpg', 45),
('Blush Powder Pink', 'cosmetics', 500.00, 'Powder blush in soft pink shade', 'cosmetics-5.jpg', 30),
('Nail Polish Red', 'cosmetics', 250.00, 'Long-lasting nail polish in bright red', 'cosmetics-6.jpg', 50);

-- TRENDING PRODUCTS (can be from any category)
INSERT INTO products (name, category, price, description, image, quantity) VALUES
('Designer Handbag', 'women', 5000.00, 'Elegant designer handbag for everyday use', 'trending-1.jpg', 8),
('Premium Watch', 'men', 8000.00, 'Stylish premium watch with leather strap', 'trending-2.jpg', 6),
('Designer Sunglasses', 'women', 3500.00, 'Fashionable designer sunglasses for sun protection', 'trending-3.jpg', 14);

-- ═══════════════════════════════════════════════════════════════
-- STEP 5: VERIFY DATA (Run these SELECT queries to check)
-- ═══════════════════════════════════════════════════════════════

-- View all products
SELECT * FROM products;

-- View products by category
SELECT * FROM products WHERE category = 'women';
SELECT * FROM products WHERE category = 'men';
SELECT * FROM products WHERE category = 'cosmetics';

-- Count products in each category
SELECT category, COUNT(*) as count FROM products GROUP BY category;

-- Find total inventory value
SELECT SUM(price * quantity) as total_value FROM products;
