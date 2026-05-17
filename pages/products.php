<head>
    <title>Products</title>
</head>

<?php
require("../config/db.php");
session_start();


$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>



<?php
include("../components/header.php");

?>

<main>
    <section class="products-hero-section">
        <h1>Products</h1>
    </section>

    <section class="products-container">

        <?php foreach ($products as $product): ?>


            <div class="product-card">

                <div class="product-image">
                    <img src="/E-Commerce-BoardPlayGR/assets/uploads/<?= htmlspecialchars($product['image']); ?>"
                        alt="<?= htmlspecialchars($product['name']); ?>">



                </div>

                <div class="product-info">

                    <h3 class="product-title">
                        <?= htmlspecialchars($product['name']); ?>
                    </h3>

                    <p class="product-desc">
                        <?= htmlspecialchars($product['description']); ?>
                    </p>

                    <div class="price-stock-container">
                        <div class="product-price">
                            €
                            <?= number_format($product['price'], 2); ?>
                        </div>

                        <div class="product-stock">
                            Stock:
                            <?= (int) $product['stock']; ?>
                        </div>
                    </div>

                    <form class="addToCart-btn-container" action="../actions/addProductToCart.php" method="POST">
                        <input type="hidden" name="id" value="<?= (int) $product['id']; ?>">

                        <button type="submit" class="addToCart-btn">
                            Add to Cart
                        </button>
                    </form>


                </div>

            </div>

        <?php endforeach; ?>
    </section>

</main>



<?php
include("../components/scroll-to-top.php");
include("../components/footer.php");
?>