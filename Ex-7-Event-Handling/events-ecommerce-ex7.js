/**
 * ═══════════════════════════════════════════════════════════════
 * EXERCISE 7: EVENT HANDLING - E-COMMERCE WEBSITE
 * ═══════════════════════════════════════════════════════════════
 * 
 * PURPOSE:
 * Demonstrates advanced event handling for e-commerce functionality:
 * - Product filtering
 * - Shopping cart management
 * - Search functionality
 * - Modal interactions
 * - User interactions
 * 
 * CONCEPTS COVERED:
 * 1. Event delegation
 * 2. Dynamic DOM manipulation
 * 3. Data management with JavaScript objects
 * 4. Event listeners on dynamic elements
 * 5. Local storage for cart persistence
 */

// ═══════════════════════════════════════════════════════════════
// SECTION 1: DATA MANAGEMENT
// ═══════════════════════════════════════════════════════════════

// Sample product data
const products = [
    {
        id: 1,
        name: 'Summer Dress',
        category: 'women',
        price: 49.99,
        emoji: '👗',
        description: 'Beautiful summer dress perfect for any occasion'
    },
    {
        id: 2,
        name: 'Casual T-Shirt',
        category: 'men',
        price: 29.99,
        emoji: '👕',
        description: 'Comfortable and stylish casual t-shirt'
    },
    {
        id: 3,
        name: 'Lipstick Set',
        category: 'cosmetics',
        price: 39.99,
        emoji: '💄',
        description: 'Premium lipstick collection with 5 shades'
    },
    {
        id: 4,
        name: 'Women Jeans',
        category: 'women',
        price: 59.99,
        emoji: '👖',
        description: 'High-quality denim jeans for women'
    },
    {
        id: 5,
        name: 'Men Shoes',
        category: 'men',
        price: 79.99,
        emoji: '👞',
        description: 'Casual shoes for everyday wear'
    },
    {
        id: 6,
        name: 'Foundation',
        category: 'cosmetics',
        price: 34.99,
        emoji: '💅',
        description: 'Long-lasting foundation for all skin types'
    }
];

// Shopping cart array to store added products
let cart = [];

// Current selected product for modal
let selectedProduct = null;

// ═══════════════════════════════════════════════════════════════
// SECTION 2: PAGE INITIALIZATION
// ═══════════════════════════════════════════════════════════════

/**
 * Initialize the page when it loads
 * Set up event listeners and display products
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded - Event handlers initialized');

    // Load cart from localStorage if exists
    const savedCart = localStorage.getItem('pahirangoCart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
        updateCartCount();
    }

    // Display all products initially
    displayProducts('all');

    // Add keyboard events
    document.addEventListener('keydown', function(event) {
        // Close modals with ESC key
        if (event.key === 'Escape') {
            handleModalClose();
            handleCartClose();
        }
    });
});

// ═══════════════════════════════════════════════════════════════
// SECTION 3: NAVIGATION EVENTS
// ═══════════════════════════════════════════════════════════════

/**
 * handleLogoClick()
 * 
 * Handles click on logo - resets to shop view
 */
function handleLogoClick() {
    console.log('Logo clicked - Resetting to shop view');
    handleFilterClick(null, 'all');
}

/**
 * handleNavClick(event, category)
 * 
 * Handles navigation menu clicks
 * 
 * PARAMETERS:
 * - event: The click event object
 * - category: Product category to filter
 */
function handleNavClick(event, category) {
    event.preventDefault();
    console.log('Navigation clicked: ' + category);
    
    // Close mobile menu
    const navMenu = document.getElementById('navMenu');
    navMenu.classList.remove('active');
    
    // Filter products
    handleFilterClick(event, category);
}

/**
 * toggleMobileNav()
 * 
 * Toggles the mobile navigation menu
 */
function toggleMobileNav() {
    const navMenu = document.getElementById('navMenu');
    navMenu.classList.toggle('active');
}

// ═══════════════════════════════════════════════════════════════
// SECTION 4: PRODUCT FILTERING AND DISPLAY
// ═══════════════════════════════════════════════════════════════

/**
 * handleFilterClick(event, category)
 * 
 * Handles product filter button clicks
 * Displays products of selected category
 * 
 * PARAMETERS:
 * - event: The click event object (can be null)
 * - category: Category to filter ('all', 'women', 'men', 'cosmetics')
 */
function handleFilterClick(event, category) {
    // If event exists, prevent default and update active button
    if (event) {
        event.preventDefault();
        
        // Remove active class from all buttons
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => btn.classList.remove('active'));
        
        // Add active class to clicked button
        event.target.classList.add('active');
    }

    console.log('Filter applied: ' + category);
    
    // Display products for selected category
    displayProducts(category);
}

/**
 * displayProducts(category)
 * 
 * Displays products for the selected category
 * Dynamically creates product cards
 * 
 * PARAMETERS:
 * - category: Product category to display ('all' for all products)
 */
function displayProducts(category) {
    // Get the products grid container
    const grid = document.getElementById('productsGrid');
    
    // Clear existing products
    grid.innerHTML = '';

    // Filter products based on category
    let filteredProducts = category === 'all' 
        ? products 
        : products.filter(p => p.category === category);

    // Create product cards for each product
    filteredProducts.forEach(product => {
        // Create product card HTML
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.innerHTML = `
            <div class="product-emoji">${product.emoji}</div>
            <h3>${product.name}</h3>
            <p>${product.description}</p>
            <p class="product-price">$${product.price.toFixed(2)}</p>
            <button class="view-btn" onclick="handleViewProduct(${product.id})">View Details</button>
            <button class="quick-add-btn" onclick="handleQuickAdd(${product.id})">Quick Add</button>
        `;

        // Add event listeners for hover effects
        productCard.addEventListener('mouseover', function() {
            handleProductHover(this);
        });
        productCard.addEventListener('mouseout', function() {
            handleProductOut(this);
        });

        // Add product card to grid
        grid.appendChild(productCard);
    });

    console.log('Displayed ' + filteredProducts.length + ' products');
}

/**
 * handleProductHover(element)
 * 
 * Adds visual feedback when hovering over product cards
 * 
 * PARAMETERS:
 * - element: The product card element
 */
function handleProductHover(element) {
    element.style.transform = 'translateY(-5px)';
    element.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.2)';
}

/**
 * handleProductOut(element)
 * 
 * Removes hover effect when mouse leaves product card
 * 
 * PARAMETERS:
 * - element: The product card element
 */
function handleProductOut(element) {
    element.style.transform = 'translateY(0)';
    element.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
}

// ═══════════════════════════════════════════════════════════════
// SECTION 5: PRODUCT DETAIL MODAL
// ═══════════════════════════════════════════════════════════════

/**
 * handleViewProduct(productId)
 * 
 * Opens product detail modal
 * 
 * PARAMETERS:
 * - productId: ID of the product to view
 */
function handleViewProduct(productId) {
    // Find the product in the products array
    selectedProduct = products.find(p => p.id === productId);

    if (selectedProduct) {
        // Populate modal with product data
        document.getElementById('modalImage').textContent = selectedProduct.emoji;
        document.getElementById('modalTitle').textContent = selectedProduct.name;
        document.getElementById('modalDesc').textContent = selectedProduct.description;
        document.getElementById('modalPrice').textContent = '$' + selectedProduct.price.toFixed(2);
        document.getElementById('modalQuantity').value = 1;

        // Show modal
        const modal = document.getElementById('productModal');
        modal.style.display = 'flex';

        console.log('Product modal opened: ' + selectedProduct.name);
    }
}

/**
 * handleModalClose()
 * 
 * Closes the product detail modal
 */
function handleModalClose() {
    const modal = document.getElementById('productModal');
    modal.style.display = 'none';
    selectedProduct = null;
}

/**
 * incrementQuantity()
 * 
 * Increases the quantity in the quantity selector
 */
function incrementQuantity() {
    const quantityInput = document.getElementById('modalQuantity');
    let currentValue = parseInt(quantityInput.value);
    
    // Increase by 1, max 10
    if (currentValue < 10) {
        quantityInput.value = currentValue + 1;
    }
}

/**
 * decrementQuantity()
 * 
 * Decreases the quantity in the quantity selector
 */
function decrementQuantity() {
    const quantityInput = document.getElementById('modalQuantity');
    let currentValue = parseInt(quantityInput.value);
    
    // Decrease by 1, min 1
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}

/**
 * handleAddToCart()
 * 
 * Adds selected product to shopping cart
 * Updates cart count and shows notification
 */
function handleAddToCart() {
    if (!selectedProduct) return;

    // Get quantity from input
    const quantity = parseInt(document.getElementById('modalQuantity').value);

    // Create cart item
    const cartItem = {
        id: selectedProduct.id,
        name: selectedProduct.name,
        price: selectedProduct.price,
        quantity: quantity,
        emoji: selectedProduct.emoji
    };

    // Check if product already in cart
    const existingItem = cart.find(item => item.id === selectedProduct.id);

    if (existingItem) {
        // Increase quantity if already in cart
        existingItem.quantity += quantity;
    } else {
        // Add new item to cart
        cart.push(cartItem);
    }

    // Save cart to localStorage
    localStorage.setItem('pahirangoCart', JSON.stringify(cart));

    // Update UI
    updateCartCount();
    
    // Show success message
    showToast(selectedProduct.name + ' added to cart!');

    // Close modal
    handleModalClose();

    console.log('Product added to cart:', cartItem);
}

/**
 * handleQuickAdd(productId)
 * 
 * Quickly adds product to cart with quantity 1
 * (without opening modal)
 * 
 * PARAMETERS:
 * - productId: ID of product to add
 */
function handleQuickAdd(productId) {
    const product = products.find(p => p.id === productId);

    if (product) {
        // Check if already in cart
        const existingItem = cart.find(item => item.id === productId);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: product.id,
                name: product.name,
                price: product.price,
                quantity: 1,
                emoji: product.emoji
            });
        }

        // Save and update
        localStorage.setItem('pahirangoCart', JSON.stringify(cart));
        updateCartCount();
        showToast(product.name + ' added to cart!');

        console.log('Quick add: ' + product.name);
    }
}

// ═══════════════════════════════════════════════════════════════
// SECTION 6: SHOPPING CART MANAGEMENT
// ═══════════════════════════════════════════════════════════════

/**
 * handleCartClick()
 * 
 * Opens the shopping cart popup
 * Displays all items in cart
 */
function handleCartClick() {
    const cartPopup = document.getElementById('cartPopup');
    const cartItemsDiv = document.getElementById('cartItems');

    // If cart is empty
    if (cart.length === 0) {
        cartItemsDiv.innerHTML = '<p style="text-align: center; color: #999;">Your cart is empty</p>';
    } else {
        // Build cart items HTML
        let cartHTML = '';
        let total = 0;

        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;

            cartHTML += `
                <div class="cart-item">
                    <span class="item-emoji">${item.emoji}</span>
                    <div class="item-details">
                        <p class="item-name">${item.name}</p>
                        <p class="item-price">$${item.price.toFixed(2)} x ${item.quantity}</p>
                    </div>
                    <div class="item-total">$${itemTotal.toFixed(2)}</div>
                    <button class="remove-btn" onclick="handleRemoveFromCart(${index})">✕</button>
                </div>
            `;
        });

        cartItemsDiv.innerHTML = cartHTML;

        // Update total price
        document.getElementById('cartTotal').textContent = total.toFixed(2);
    }

    // Show cart popup
    cartPopup.style.display = 'flex';

    console.log('Cart opened - Items: ' + cart.length);
}

/**
 * handleCartClose()
 * 
 * Closes the shopping cart popup
 */
function handleCartClose() {
    const cartPopup = document.getElementById('cartPopup');
    cartPopup.style.display = 'none';
}

/**
 * handleRemoveFromCart(index)
 * 
 * Removes an item from the shopping cart
 * 
 * PARAMETERS:
 * - index: Index of the item to remove
 */
function handleRemoveFromCart(index) {
    // Remove from cart array
    const removedItem = cart[index];
    cart.splice(index, 1);

    // Save to localStorage
    localStorage.setItem('pahirangoCart', JSON.stringify(cart));

    // Refresh cart display
    updateCartCount();
    handleCartClick(); // Re-open to show updated cart

    // Show notification
    showToast(removedItem.name + ' removed from cart');

    console.log('Item removed from cart:', removedItem);
}

/**
 * updateCartCount()
 * 
 * Updates the cart count badge in header
 */
function updateCartCount() {
    // Calculate total items in cart
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

    // Update cart count display
    document.getElementById('cartCount').textContent = totalItems;

    console.log('Cart updated - Total items: ' + totalItems);
}

/**
 * handleCheckout()
 * 
 * Handles checkout button click
 */
function handleCheckout() {
    if (cart.length === 0) {
        showToast('Your cart is empty!');
        return;
    }

    // Calculate total
    const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

    // Show checkout message
    showToast('Proceeding to checkout for $' + total.toFixed(2));

    // In real application, redirect to payment gateway
    setTimeout(() => {
        alert('Thank you for your order! Total: $' + total.toFixed(2));
        // Clear cart after checkout
        cart = [];
        localStorage.setItem('pahirangoCart', JSON.stringify(cart));
        updateCartCount();
        handleCartClose();
    }, 1000);

    console.log('Checkout initiated - Total: $' + total.toFixed(2));
}

// ═══════════════════════════════════════════════════════════════
// SECTION 7: SEARCH FUNCTIONALITY
// ═══════════════════════════════════════════════════════════════

/**
 * handleSearchFocus(event)
 * 
 * Handles focus event on search input
 * 
 * PARAMETERS:
 * - event: The focus event object
 */
function handleSearchFocus(event) {
    const input = event.target;
    input.style.borderColor = '#667eea';
    input.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)';
}

/**
 * handleSearchBlur(event)
 * 
 * Handles blur event when user leaves search input
 * 
 * PARAMETERS:
 * - event: The blur event object
 */
function handleSearchBlur(event) {
    const input = event.target;
    input.style.borderColor = '#e0e0e0';
    input.style.boxShadow = 'none';
}

/**
 * handleSearchInput(event)
 * 
 * Handles real-time search input
 * Filters products as user types
 * 
 * PARAMETERS:
 * - event: The keyup event object
 */
function handleSearchInput(event) {
    const searchTerm = event.target.value.toLowerCase();

    // Filter products based on search term
    let filteredProducts = products.filter(p => 
        p.name.toLowerCase().includes(searchTerm) ||
        p.description.toLowerCase().includes(searchTerm)
    );

    // Display search results
    const grid = document.getElementById('productsGrid');
    grid.innerHTML = '';

    filteredProducts.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.innerHTML = `
            <div class="product-emoji">${product.emoji}</div>
            <h3>${product.name}</h3>
            <p>${product.description}</p>
            <p class="product-price">$${product.price.toFixed(2)}</p>
            <button class="view-btn" onclick="handleViewProduct(${product.id})">View Details</button>
            <button class="quick-add-btn" onclick="handleQuickAdd(${product.id})">Quick Add</button>
        `;

        productCard.addEventListener('mouseover', function() {
            handleProductHover(this);
        });
        productCard.addEventListener('mouseout', function() {
            handleProductOut(this);
        });

        grid.appendChild(productCard);
    });

    console.log('Search: "' + searchTerm + '" - ' + filteredProducts.length + ' results');
}

// ═══════════════════════════════════════════════════════════════
// SECTION 8: USER INTERACTION EVENTS
// ═══════════════════════════════════════════════════════════════

/**
 * handleUserClick()
 * 
 * Handles user profile icon click
 */
function handleUserClick() {
    alert('Login feature coming soon!\nFor demo, login with:\nEmail: demo@pahirango.com\nPassword: Demo@123');
}

/**
 * handleButtonHover(element)
 * 
 * Hover effect for buttons
 * 
 * PARAMETERS:
 * - element: The button element
 */
function handleButtonHover(element) {
    element.style.transform = 'scale(1.05)';
}

/**
 * handleButtonOut(element)
 * 
 * Removes hover effect from buttons
 * 
 * PARAMETERS:
 * - element: The button element
 */
function handleButtonOut(element) {
    element.style.transform = 'scale(1)';
}

/**
 * handleShopNowClick()
 * 
 * Handles "Shop Now" button click on banner
 */
function handleShopNowClick() {
    // Scroll to products section
    const productsSection = document.querySelector('.products-section');
    if (productsSection) {
        productsSection.scrollIntoView({ behavior: 'smooth' });
    }
    console.log('Shop Now clicked');
}

// ═══════════════════════════════════════════════════════════════
// SECTION 9: UTILITY FUNCTIONS
// ═══════════════════════════════════════════════════════════════

/**
 * showToast(message)
 * 
 * Shows a toast notification message
 * Automatically disappears after 3 seconds
 * 
 * PARAMETERS:
 * - message: The message to display
 */
function showToast(message) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.style.display = 'block';

    // Hide after 3 seconds
    setTimeout(() => {
        toast.style.display = 'none';
    }, 3000);
}

// ═══════════════════════════════════════════════════════════════
// END OF EXERCISE 7 - EVENT HANDLING (E-COMMERCE)
// ═══════════════════════════════════════════════════════════════
