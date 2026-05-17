<?php

session_start();
require("../config/db.php");
require("../actions/auth.php");


include("../components/header.php");

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare
("SELECT id FROM orders 
WHERE user_id = ?
ORDER BY id DESC 
LIMIT 1");
$stmt->execute([$user_id]);

$result = $stmt->fetch();

$order_id = $result["id"];




?>

<main>
    <div style="display: flex; justify-content: center;">
        <h1 class="order-success-message">Your order was successfully placed with order ID: <?= $order_id ?></h1>
    </div>
    <div style="display: flex; justify-content: center;">
        <a class="order-success-btn" href="./products.php">Continue Shopping</a>
    </div>

</main>

<?php include("../components/footer.php"); ?>