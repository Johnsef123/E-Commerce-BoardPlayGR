<?php
session_start();
require("../config/db.php");


//get the top three products based on copies sold
$stmt = $pdo->prepare(
    "SELECT
        products.id,
        products.name,
        products.description,
        products.price,
        products.stock,
        products.image,
        COALESCE(SUM(order_items.quantity), 0) AS total_sold
    FROM products
    LEFT JOIN order_items
        ON order_items.product_id = products.id
    GROUP BY products.id
    ORDER BY total_sold DESC
    LIMIT 3;
    "
);
$stmt->execute();
$bestSellers = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>





<?php include("../components/header.php"); ?>
<main>
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Play More. Laugh More.<br />
                Live More.</h1>
            <p class="hero-description">Find your next favorite
                board game and make memories.</p>
            <a class="hero-cta-btn" href="./products.php">Shop Now</a>
        </div>
    </section>

    <section class="best-sellers">
        <div class="best-sellers-content">
            <h1 class="best-sellers-title">Best Sellers</h1>
            <div class="products">

                <?php foreach ($bestSellers as $product): ?>


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

            </div>
        </div>
    </section>

    <div class="divider white-black"></div>

    <section class="about-section">
        <div class="about-content">
            <h1>
                About us
            </h1>
            <p>
                At BoardPlayGR, we design and create unique board games made to bring <br />
                people together and spark unforgettable moments. Explore our original <br />
                collection and discover games crafted with passion and creativity – made <br />
                just for you to enjoy!
            </p>

        </div>
    </section>

    <div class="divider black-white"></div>






</main>
<?php include("../components/scroll-to-top.php"); ?>
<?php include("../components/footer.php"); ?>