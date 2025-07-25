<?php
session_start();
$menu = [
    ['name' => 'Plain Water', 'price' => 0.5, 'image' => 'images/plain_water.jpg'],
    ['name' => 'Hot Lemon Tea', 'price' => 2.5, 'image' => 'images/hot_lemon_tea.jpg'],
    ['name' => 'Hot Ribena', 'price' => 3.5, 'image' => 'images/hot_ribena.jpg'],
    ['name' => 'Hot Passionfruit', 'price' => 4.0, 'image' => 'images/hot_passionfruit.jpg'],
    ['name' => 'Hot Coffee', 'price' => 4.5, 'image' => 'images/hot_coffee.jpg'],
    ['name' => 'Hot Matcha', 'price' => 4.5, 'image' => 'images/hot_matcha.jpg'],
    ['name' => 'Iced Lemon Tea', 'price' => 3.0, 'image' => 'images/iced_tea.jpg'],
    ['name' => 'Iced Green Tea', 'price' => 3.5, 'image' => 'images/iced_green_tea.jpg'],
    ['name' => 'Kiwi Passionfruit', 'price' => 3.5, 'image' => 'images/kiwi_passionfruit.jpg'],
    ['name' => 'Coca-Cola', 'price' => 4.5, 'image' => 'images/coke.jpg'],
    ['name' => 'Ribena Longan', 'price' => 5.0, 'image' => 'images/ribena_longan.jpg'],
    ['name' => 'Strawberry_fizzy', 'price' => 5.5, 'image' => 'images/coke.jpg'],
];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item'])) {
    $_SESSION['cart'][] = (int) $_POST['item'];
    $_SESSION['cart'][] = $item_id;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Drink Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1> Drink Menu</h1>
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
