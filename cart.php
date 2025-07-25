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

$cart = $_SESSION['cart'] ?? [];

// Count quantity of each item
$filtered_cart = array_filter($cart, function ($id) use ($menu) {
    return is_numeric($id) && isset($menu[$id]);
});
$quantities = array_count_values($filtered_cart);

// Handle quantity changes (+ / -)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qty_id'], $_POST['qty_action'])) {
    $qty_id = (int)$_POST['qty_id'];
    $qty_action = $_POST['qty_action'];
    if ($qty_action === 'plus') {
        $_SESSION['cart'][] = $qty_id;
    } elseif ($qty_action === 'minus') {
        $index = array_search($qty_id, $_SESSION['cart']);
        if ($index !== false) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
    header("Location: cart.php");
    exit();
}

// Remove item from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
    $remove_id = $_POST['remove_id'];
    $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function($id) use ($remove_id) {
        return $id != $remove_id;
    }));
    header("Location: cart.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $_SESSION['cart'] = []; // clear cart
    $_SESSION['order_placed'] = true;
    header("Location: cart.php");
    exit();
}

// Check if order was just placed (before we potentially unset it)
$order_just_placed = isset($_SESSION['order_placed']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    // ...add to cart logic...
    if (
        isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    ) {
        // Only output JSON and exit for AJAX
        echo json_encode(['success' => true, 'cartCount' => count($_SESSION['cart'])]);
        exit;
    } else {
        // For normal POST, redirect to avoid resubmission and show HTML
        header("Location: cart.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .cart-container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 20px;
        }
        .cart-item-info {
            flex: 1;
            text-align: left;
        }
        .cart-item-info h3 {
            margin: 0 0 5px;
        }
        .cart-item-info p {
            margin: 0;
            color: #888;
        }
        .cart-item form {
            margin-left: 15px;
        }
        .cart-total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
            font-size: 18px;
        }
        .empty-message {
            text-align: center;
            margin: 40px 0;
            color: #999;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            background: #f39c12;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
        }
        .place-order-btn {
            background: #27ae60;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .place-order-btn:hover {
            background: #219a52;
        }
        .qty-controls {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .qty-btn {
            background: #eee;
            border: none;
            border-radius: 4px;
            width: 28px;
            height: 28px;
            font-size: 18px;
            cursor: pointer;
        }
        .qty-btn:active {
            background: #ccc;
        }
        .qty-value {
            min-width: 24px;
            text-align: center;
            font-weight: bold;
        }
        .remove-btn {
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            margin-left: 10px;
            cursor: pointer;
        }
        .remove-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h1>Your Cart</h1>

    <?php if ($order_just_placed): ?>
        <p style="color: green; font-weight: bold;">Your order has been sent to the counter. Please pay after your meal.</p>
        <?php unset($_SESSION['order_placed']); // Clear it after showing the message ?>
    <?php endif; ?>

    <?php if (empty($cart)): ?>
        <p class="empty-message">Order Successful.</p>
    <?php else: ?>
        <?php $total = 0; ?>
        <?php foreach ($quantities as $id => $qty): ?>
            <?php
                $item = $menu[$id];
                $subtotal = $item['price'] * $qty;
                $total += $subtotal;
            ?>
            <div class="cart-item">
                <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                <div class="cart-item-info">
                    <h3><?= htmlspecialchars($item['name']) ?></h3>
                    <p>
                        RM <?= number_format($item['price'], 2) ?> × 
                        <span class="qty-controls">
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="qty_id" value="<?= $id ?>">
                                <input type="hidden" name="qty_action" value="minus">
                                <button type="submit" class="qty-btn"<?= $qty <= 1 ? ' disabled' : '' ?>>-</button>
                            </form>
                            <span class="qty-value"><?= $qty ?></span>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="qty_id" value="<?= $id ?>">
                                <input type="hidden" name="qty_action" value="plus">
                                <button type="submit" class="qty-btn">+</button>
                            </form>
                        </span>
                        = RM <?= number_format($subtotal, 2) ?>
                    </p>
                </div>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="remove_id" value="<?= $id ?>">
                    <button type="submit" class="remove-btn">Remove</button>
                </form>
            </div>
        <?php endforeach; ?>

        <div class="cart-total">
            Total: RM <?= number_format($total, 2) ?>
        </div>
        
    <?php endif; ?>

    <a href="index.php" class="back-button">← Back to Menu</a>

    <?php if (!empty($cart) && !$order_just_placed): ?>
        <form method="post">
            <button type="submit" name="place_order" class="place-order-btn">Place Order</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>