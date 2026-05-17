<!DOCTYPE html5>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BoardPlayGR</title>
    <link rel="icon" type="image/x-icon" href="/E-Commerce-BoardPlayGR/assets/pictures/board-play-gr-logo.png">

    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/variables.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/header.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/main.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/index.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/footer.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/scroll-to-top.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/products.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/cart.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/signUp.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/signIn.css">
    <link rel="stylesheet" href="/E-Commerce-BoardPlayGR/assets/css/order-success.css">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Elms+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


</head>

<?php
require("../config/db.php");


if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    $stmt = $pdo->prepare
    ("SELECT SUM(ci.quantity) AS total_items
FROM cart_items AS ci
JOIN cart c ON c.id = ci.cart_id
WHERE c.user_id = ?");

    $stmt->execute([$user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_items = $result["total_items" ?? 0];

}


?>


<body>

    <header>
        <nav class="navbar">
            <div class="logo-container">
                <a href="index.php">
                    <img class="logo" src="/E-Commerce-BoardPlayGR/assets/pictures/board-play-gr-logo.png">
                </a>
            </div>
            <div class="first-list">



                <a href="index.php">Home</a>

                <a href="products.php">Products</a>

                <a class="second-list-item" href="cart.php">Cart <svg xmlns="http://www.w3.org/2000/svg" width="20"
                        height="20" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                        <path
                            d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                    </svg>
                    (<?php if (isset($_SESSION["user_id"])) {
                        echo (int) $total_items;
                    } else {
                        echo ("0");
                    } ?>)
                </a>

            </div>



            <div class="second-list">
                <?php
                if (!isset($_SESSION["user_id"])): ?>

                    <a class="second-list-item" href="signIn.php">Sign In</a>

                    <a class="signUp-btn" href="signUp.php">Sign Up</a>

                <?php else: ?>

                    <span>Welcome <?php echo $_SESSION["username"] ?></span>

                    <a class="signOut-btn" href="/E-Commerce-BoardPlayGR/actions/signOut.php">Sign Out</a>
                <?php endif; ?>
            </div>
        </nav>

    </header>