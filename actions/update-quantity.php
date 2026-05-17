<?php

require("../config/db.php");
session_start();

$data = json_decode(file_get_contents("php://input"), true);


$cart_item_id = (int)$data["cart_item_id"];
$quantity = (int)$data["quantity"];

if ($cart_item_id === 0) {
    echo "Invalid product ID";
    exit;
}

if($quantity === 0){
    $stmt = $pdo->prepare("DELETE FROM cart_items WHERE id = ?");
    $stmt->execute([$cart_item_id]);
}

$stmt = $pdo->prepare("UPDATE cart_items SET quantity=? WHERE id = ?");
$stmt->execute([$quantity, $cart_item_id]);



?>
<script>console.log("We reached here");</script>