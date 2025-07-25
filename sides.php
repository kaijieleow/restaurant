<?php
session_start();
$menu = [
    ['name' => 'Fries', 'price' => 4.0, 'image' => 'images/fries.png'],
    ['name' => 'Onion Rings', 'price' => 6.0, 'image' => 'images/onion.png'],
    ['name' => 'Wedges', 'price' => 7.50, 'image' => 'images/wedges.png'],
    ['name' => 'Mushroom Soup', 'price' => 6.0, 'image' => 'images/mush.png'],
    ['name' => 'Garlic Bread', 'price' => 2.5, 'image' => 'images/garlic.png'],
    ['name' => 'Mashed Potato', 'price' => 5.0, 'image' => 'images/potato.png'],
];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item'])) {
    $_SESSION['cart'][] = (int) $_POST['item'];
    $_SESSION['cart'][] = $item_id;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sides menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1> Sides Menu</h1>
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