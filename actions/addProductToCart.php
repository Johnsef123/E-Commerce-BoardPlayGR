<?php
require("../config/db.php");
session_start();

require("../actions/auth.php");

$user_id = $_SESSION["user_id"];

$product_id = (int) $_POST["id"];

//check if cart exists
$stmt = $pdo->prepare("SELECT id 
    from cart 
    WHERE user_id = ?
    LIMIT 1"
);

$stmt->execute([$user_id]);

$cart = $stmt->fetch();

//get the cart id or create a new one
if ($cart) {
    $cart_id = $cart["id"];
} else {
    $stmt = $pdo->prepare(
        "INSERT INTO cart (user_id) VALUES (?)"
    );

    $stmt->execute([$user_id]);

    $cart_id = $pdo->lastInsertId();
}

//check if the product exists
$stmt = $pdo->prepare(
"SELECT id, quantity 
FROM cart_items
WHERE cart_id = ? AND product_id=?");

$stmt ->execute([$cart_id, $product_id]);

$item = $stmt->fetch();

//change quantity or insert
if($item){
    $stmt = $pdo->prepare(
        "UPDATE cart_items
        SET quantity = quantity + 1
        WHERE id = ?"
        );
        $stmt ->execute([$item["id"]]);
}
else{
    $stmt = $pdo->prepare(
        "INSERT INTO cart_items (cart_id, product_id, quantity)
        VALUES (?,?,1)");

        $stmt ->execute([$cart_id, $product_id]);
}

header("Location: ".$_SERVER["HTTP_REFERER"]);
exit();

?>