<?php
session_start();
$menu = [
    ['name' => 'Classic Burger', 'price' => 6.5, 'image' => 'images/classic_burger.jpg'],
    ['name' => 'Fish Tuna Burger', 'price' => 7.5, 'image' => 'images/fish_tuna.jpg'],
    ['name' => 'Mushroom Veggie Burger', 'price' => 9.5, 'image' => 'images/mushroom_veggie.jpg'],
    ['name' => 'Mushroom Beef Burger', 'price' => 10.5, 'image' => 'images/mushroom_beef.jpg'],
    ['name' => 'Long Chicken Burger', 'price' => 11.0, 'image' => 'images/long_chicken.jpg'],
    ['name' => 'Egg Bacon Burger', 'price' => 11.5, 'image' => 'images/egg_bacon.jpg'],
    ['name' => 'Special Burger', 'price' => 12.5, 'image' => 'images/special_burger.jpg'],
    ['name' => 'Triple Cheese Burger', 'price' => 13.0, 'image' => 'images/triple_cheese_burger.jpg'],
];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
    $_SESSION['cart'][] = (int) $_POST['item_id'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Burger Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1> Burger Menu</h1>
    <div class="menu">
        <?php foreach ($menu as $index => $item): ?>
        <div class="card">
            <img src="<?= $item['image'] ?>" class="menu-img">
            <h2><?= $item['name'] ?></h2>
            <p>RM<?= number_format($item['price'], 2) ?></p>
            <form method="post">
                <input type="hidden" name="item_id" value="<?= $index ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
    <a href="cart.php" class="cart-link"> View Cart</a>
    <a href="index.php" class="tab-button">← Back</a>
</body>
</html>
