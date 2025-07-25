<?php
session_start();

$menu = [
    1 => ['name' => 'Classic Burger', 'price' => 6.5, 'image' => 'images/classic_burger.jpg', 'category' => 'food', 'type' => 'burger'],
    2 => ['name' => 'Fish Tuna Burger', 'price' => 7.5, 'image' => 'images/fish_tuna.jpg', 'category' => 'food', 'type' => 'burger'],
    3 => ['name' => 'Mushroom Veggie Burger', 'price' => 9.5, 'image' => 'images/mushroom_veggie.jpg', 'category' => 'food', 'type' => 'burger'],
    4 => ['name' => 'Mushroom Beef Burger', 'price' => 10.5, 'image' => 'images/mushroom_beef.jpg', 'category' => 'food', 'type' => 'burger'],
    5 => ['name' => 'Long Chicken Burger', 'price' => 11.0, 'image' => 'images/long_chicken.jpg', 'category' => 'food', 'type' => 'burger'],
    6 => ['name' => 'Egg Bacon Burger', 'price' => 11.5, 'image' => 'images/egg_bacon.jpg', 'category' => 'food', 'type' => 'burger'],
    7 => ['name' => 'Special Burger', 'price' => 12.5, 'image' => 'images/special_burger.jpg', 'category' => 'food', 'type' => 'burger'],
    8 => ['name' => 'Triple Cheese Burger', 'price' => 13.0, 'image' => 'images/triple_cheese_burger.jpg', 'category' => 'food', 'type' => 'burger'],
    9 => ['name' => 'Pepperoni Pizza', 'price' => 10.0, 'image' => 'images/pepperoni_pizza.jpg', 'category' => 'food', 'type' => 'pizza'],
    10=> ['name' => 'BBQ Chicken Pizza', 'price' => 11.5, 'image' => 'images/BBQ_chicken.jpg', 'category' => 'food', 'type' => 'pizza'],
    11 => ['name' => 'Hawaiian Pizza', 'price' => 12.0, 'image' => 'images/hawaiian_pizza.jpg', 'category' => 'food', 'type' => 'pizza'],
    12 => ['name' => 'Ham and Cheese Pizza', 'price' => 12.5, 'image' => 'images/ham_and_cheese_pizza.jpg', 'category' => 'food', 'type' => 'pizza'],
    13 => ['name' => 'Chicken and Bacon Pizza', 'price' => 15.0, 'image' => 'images/chicken_bacon_and_ranch_pizza.jpg', 'category' => 'food', 'type' => 'pizza'],
    14 => ['name' => 'Seafood Pizza', 'price' => 16.5, 'image' => 'images/seafood_pizza.jpg', 'category' => 'food', 'type' => 'pizza'],
    15 => ['name' => 'Plain Water', 'price' => 0.5, 'image' => 'images/plain_water.jpg', 'category' => 'drink'],
    16 => ['name' => 'Hot Lemon Tea', 'price' => 2.5, 'image' => 'images/hot_lemon_tea.jpg', 'category' => 'drink'],
    17 => ['name' => 'Hot Ribena', 'price' => 3.5, 'image' => 'images/hot_ribena.jpg', 'category' => 'drink'],
    18 => ['name' => 'Hot Passionfruit', 'price' => 4.0, 'image' => 'images/hot_passionfruit.jpg', 'category' => 'drink'],
    19 => ['name' => 'Hot Coffee', 'price' => 4.5, 'image' => 'images/hot_coffee.jpg', 'category' => 'drink'],
    20=> ['name' => 'Hot Matcha', 'price' => 4.5, 'image' => 'images/hot_matcha.jpg', 'category' => 'drink'],
    21 => ['name' => 'Iced Lemon Tea', 'price' => 3.0, 'image' => 'images/iced_tea.jpg', 'category' => 'drink'],
    22 => ['name' => 'Iced Green Tea', 'price' => 3.5, 'image' => 'images/iced_green_tea.jpg', 'category' => 'drink'],
    23 => ['name' => 'Kiwi Passionfruit', 'price' => 3.5, 'image' => 'images/kiwi_passionfruit.jpg', 'category' => 'drink'],
    24 => ['name' => 'Coca-Cola', 'price' => 4.5, 'image' => 'images/coke.jpg', 'category' => 'drink'],
    25 => ['name' => 'Ribena Longan', 'price' => 5.0, 'image' => 'images/ribena_longan.jpg', 'category' => 'drink'],
    26 => ['name' => 'Strawberry_fizzy', 'price' => 5.5, 'image' => 'images/coke.jpg', 'category' => 'drink'],
    27 => ['name' => 'Fries', 'price' => 4.0, 'image' => 'images/fries.png', 'category' => 'sides'],
    28 => ['name' => 'Onion Rings', 'price' => 6.0, 'image' => 'images/onion.png', 'category' => 'sides'],
    29 => ['name' => 'Wedges', 'price' => 7.50, 'image' => 'images/wedges.png', 'category' => 'sides'],
    30=> ['name' => 'Mushroom Soup', 'price' => 6.0, 'image' => 'images/mush.png', 'category' => 'sides'],
    31 => ['name' => 'Garlic Bread', 'price' => 2.5, 'image' => 'images/garlic.png', 'category' => 'sides'],
    32 => ['name' => 'Mashed Potato', 'price' => 5.0, 'image' => 'images/potato.png', 'category' => 'sides'],
];


// Handle Add to Cart Request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['item_id'])) {
    $item_id = (int)$_POST['item_id'];
    $quantity = isset($_POST['quantity']) ? max(0, (int)$_POST['quantity']) : 0; 

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Only add the selected item, no default items
    for ($i = 0; $i < $quantity; $i++) {
        $_SESSION['cart'][] = $item_id;
    }

    // Log the item_id for debugging
    error_log('Adding item_id: ' . $item_id);

    // Return updated cart count to JavaScript
    echo json_encode(['success' => true, 'cartCount' => count($_SESSION['cart'])]);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header" id="mainHeader">
        <h1> Welcome to BBQ</h1>
        <a href="cart.php" class="cart-link" id="cartLink">
             Cart <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
        </a>
    </div>
    <!-- Cart empty modal -->
    <div id="emptyCartModal" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.25);z-index:9999;align-items:center;justify-content:center;">
        <div style="background:#fff;padding:32px 40px;border-radius:12px;box-shadow:0 4px 24px rgba(0,0,0,0.15);font-size:1.2em;min-width:220px;">
            <span>Your cart is empty.</span>
            <br><br>
            <button onclick="document.getElementById('emptyCartModal').style.display='none'" style="background:#f39c12;color:#fff;border:none;padding:8px 22px;border-radius:7px;font-size:1em;cursor:pointer;">OK</button>
        </div>
    </div>
    <div class="banner">
        <img src="images/banner.jpg" alt="Welcome Banner">
    </div>

    <!-- Add this section for tabs -->
    <div class="tabs">
        <button class="tab-button active" onclick="showSlide('pizza')">Pizzas</button>
        <button class="tab-button" onclick="showSlide('burger')">Burgers</button>
        <button class="tab-button" onclick="showSlide('drink')">Drinks</button>
        <button class="tab-button" onclick="showSlide('sides')">Sides</button>
    </div>

    <div class="slider-container">
        <div class="menu-section" data-type="pizza">
            <h2>Pizza</h2>
            <div class="menu-container">
                <?php foreach ($menu as $id => $item): ?>
                    <?php if (($item['type'] ?? '') === 'pizza'): ?>
                        <div class="menu-item" data-type="pizza">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                            <h3><?php echo $item['name']; ?></h3>
                            <p>RM <?php echo number_format($item['price'], 2); ?></p>
                            <form method="post" class="add-to-cart-form">
                                <input type="hidden" name="item_id" value="<?= $id ?>">
                                <div class="qty-controls" style="display:flex;align-items:center;gap:5px;margin-bottom:8px;">
                                    <button type="button" class="qty-btn" onclick="changeQty(this, -1)">-</button>
                                    <input type="number" name="quantity" value="1" min="1" style="width:40px;text-align:center;" readonly>
                                    <button type="button" class="qty-btn" onclick="changeQty(this, 1)">+</button>
                                </div>
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="menu-section" data-type="burger">
            <h2>Burger</h2>
            <div class="menu-container">
                <?php foreach ($menu as $id => $item): ?>
                    <?php if (($item['type'] ?? '') === 'burger'): ?>
                        <div class="menu-item" data-type="burger">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                            <h3><?php echo $item['name']; ?></h3>
                            <p>RM <?php echo number_format($item['price'], 2); ?></p>
                            <form method="post" class="add-to-cart-form">
                                <input type="hidden" name="item_id" value="<?= $id ?>">
                                <div class="qty-controls" style="display:flex;align-items:center;gap:5px;margin-bottom:8px;">
                                    <button type="button" class="qty-btn" onclick="changeQty(this, -1)">-</button>
                                    <input type="number" name="quantity" value="1" min="1" style="width:40px;text-align:center;" readonly>
                                    <button type="button" class="qty-btn" onclick="changeQty(this, 1)">+</button>
                                </div>
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="menu-section" data-type="drink">
            <h2>Drinks</h2>
            <div class="menu-container">
                <?php foreach ($menu as $id => $item): ?>
                    <?php if (($item['category'] ?? '') === 'drink'): ?>
                        <div class="menu-item" data-type="drink">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                            <h3><?php echo $item['name']; ?></h3>
                            <p>RM <?php echo number_format($item['price'], 2); ?></p>
                            <form method="post" class="add-to-cart-form">
                                <input type="hidden" name="item_id" value="<?= $id ?>">
                                <div class="qty-controls" style="display:flex;align-items:center;gap:5px;margin-bottom:8px;">
                                    <button type="button" class="qty-btn" onclick="changeQty(this, -1)">-</button>
                                    <input type="number" name="quantity" value="1" min="1" style="width:40px;text-align:center;" readonly>
                                    <button type="button" class="qty-btn" onclick="changeQty(this, 1)">+</button>
                                </div>
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="menu-section" data-type="sides">
            <h2>Sides</h2>
            <div class="menu-container">
                <?php foreach ($menu as $id => $item): ?>
                    <?php if (($item['category'] ?? '') === 'sides'): ?>
                        <div class="menu-item" data-type="sides">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                            <h3><?php echo $item['name']; ?></h3>
                            <p>RM <?php echo number_format($item['price'], 2); ?></p>
                            <form method="post" class="add-to-cart-form">
                                <input type="hidden" name="item_id" value="<?= $id ?>">
                                <div class="qty-controls" style="display:flex;align-items:center;gap:5px;margin-bottom:8px;">
                                    <button type="button" class="qty-btn" onclick="changeQty(this, -1)">-</button>
                                    <input type="number" name="quantity" value="1" min="1" style="width:40px;text-align:center;" readonly>
                                    <button type="button" class="qty-btn" onclick="changeQty(this, 1)">+</button>
                                </div>
                                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer class="footer-white"></footer>

    <script src="script.js"></script>
    <script>
    // Add + - quantity logic for all menu items
    function changeQty(btn, delta) {
        var qtyInput = btn.parentNode.querySelector('input[name="quantity"]');
        var current = parseInt(qtyInput.value, 10);
        var min = parseInt(qtyInput.min, 10) || 1;
        var next = current + delta;
        if (next < min) next = min;
        qtyInput.value = next;
    }

    // Cart empty modal logic
    document.getElementById('cartLink').addEventListener('click', function(e) {
        var cartCount = parseInt(document.querySelector('.cart-count').textContent, 10) || 0;
        if (cartCount === 0) {
            e.preventDefault();
            document.getElementById('emptyCartModal').style.display = 'flex';
        }
    });
    </script>
</body>
</html>