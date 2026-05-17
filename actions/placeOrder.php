<?php

session_start();
require("../config/db.php");

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare
("SELECT
cart_item.product_id,
cart_item.quantity,
product.price AS product_price
FROM cart_items cart_item
JOIN products product ON product.id = cart_item.product_id
JOIN cart c ON c.id = cart_item.cart_id
WHERE c.user_id = ? ");

$stmt->execute([$user_id]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$cartItems) {
    exit("Cart is Empty");
}

$total = 0;

foreach ($cartItems as $item) {
    $total += $item["quantity"] * $item["product_price"];
}

$stmt = $pdo->prepare
("INSERT INTO orders(user_id, total_price)
VALUES (?,?)");
$stmt->execute([$user_id, $total]);

$orderId = $pdo->lastInsertId();

$stmt = $pdo->prepare
("INSERT INTO order_items (order_id, product_id, quantity, price)
VALUES (?,?,?,?)");


foreach ($cartItems as $item) {
    $stmt->execute([
        $orderId,
        $item["product_id"],
        $item["quantity"],
        $item["product_price"]
    ]);
}

$stmt = $pdo->prepare
("DELETE FROM cart
WHERE user_id = ?");
$stmt->execute([$user_id]);

header("Location: ../pages/order-success.php");
exit();


?>