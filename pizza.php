<?php
session_start();
$menu = [
    ['name' => 'Pepperoni Pizza', 'price' => 10.0, 'image' => 'images/pepperoni_pizza.jpg'],
    ['name' => 'BBQ Chicken Pizza', 'price' => 11.5, 'image' => 'images/BBQ_chicken.jpg'],
    ['name' => 'Hawaiian Pizza', 'price' => 12.0, 'image' => 'images/hawaiian_pizza.jpg']
    ['name' => 'Ham and Cheese Pizza', 'price' => 12.5, 'image' => 'images/ham_and_cheese_pizza.jpg']
    ['name' => 'Chicken, Bacon and Ranch Pizza', 'price' => 15.0, 'image' => 'images/chicken_bacon_and_ranch_pizza.jpg']
    ['name' => 'Seafood Pizza', 'price' => 16.5, 'image' => 'images/seafood_pizza.jpg'],
];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item'])) {
    $_SESSION['cart'][] = (int) $_POST['item'];
    $_SESSION['cart'][] = $item_id;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pizza Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1> Pizza Menu</h1>
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