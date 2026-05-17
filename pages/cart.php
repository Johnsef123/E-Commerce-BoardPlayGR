<head>
    <title>Cart</title>
</head>

<?php
session_start();
require("../config/db.php");
require("../actions/auth.php");

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("SELECT id FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart = $stmt->fetch();



if ($cart) {
    $cart_id = $cart["id"];

    $stmt = $pdo->prepare(
        "SELECT
        cart_items.id AS cart_item_id,
        cart_items.quantity,
        products.id,
        products.name,
        products.description,
        products.price,
        products.image
    FROM cart_items
    JOIN products
        on cart_items.product_id = products.id
    WHERE cart_items.cart_id = ?
    "
    );

    $stmt->execute([$cart_id]);

    $cart_items = $stmt->fetchAll();


    $subtotal = 0;
    $total = 0;
}


?>



<?php include("../components/header.php"); ?>




<main>

    <?php if ($cart && $cart_items): ?>
        <h1 class="cart-title">Cart</h1>
        <form class="cart-container" action="../actions/placeOrder.php" method="POST">

            <?php foreach ($cart_items as $cart_item): ?>

                <?php
                $subtotal = $cart_item['price'] * $cart_item['quantity'];
                $total += $subtotal;
                ?>

                <div class="cart-item">

                    <img src="/E-Commerce-BoardPlayGR/assets/uploads/<?= htmlspecialchars($cart_item['image']); ?>">

                    <div class="cart-info">
                        <div class="cart-item-title">
                            <h2>
                                <?= htmlspecialchars($cart_item['name']); ?>
                            </h2>
                        </div>




                        <div class="cart-item-rest">

                            <p>
                                Price:
                                €
                                <?= number_format($cart_item['price'], 2); ?>
                            </p>


                            <p>
                                Quantity:
                                <button type="button" class="minus-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-dash-square" viewBox="0 0 16 16">
                                        <path
                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                    </svg>
                                </button>

                                <input type="text" min="1" data-cart-item-id="<?= $cart_item["cart_item_id"] ?>"
                                    class="quantity-input-field" name="quantity" readonly
                                    value="<?= $cart_item["quantity"] ?>" />

                                <button type="button" class="plus-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path
                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg></button>
                            </p>
                            <p>
                                Subtotal:
                                €
                                <?= number_format($subtotal, 2); ?>
                            </p>
                        </div>


                    </div>
                </div>
            <?php endforeach; ?>



            <div class="cart-total">
                <h2>Total: €<?= number_format($total, 2); ?></h2>
            </div>
            <div class="cart-btns">
                <a class="return-to-products" href="products.php">
                    Continue Shopping
                </a>
                <button type="submit" class="order-placement-btn">
                    Place Order
                </button>
            </div>
        </form>
    <?php else: ?>
        <div style="display: flex; justify-content: center;">
            <h1 class="empty-cart-message">Your cart is Empty</h1>
        </div>
        <div style="display: flex; justify-content: center;">
            <a href="./products.php" class="empty-cart-btn">Continue Shopping</a>
        </div>



    <?php endif; ?>







</main>


<?php include("../components/scroll-to-top.php") ?>
<?php include("../components/footer.php") ?>