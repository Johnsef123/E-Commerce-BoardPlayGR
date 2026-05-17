<head>
    <title>Sign In</title>
</head>

<?php
session_start();
require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $credential = trim($_POST["username_or_email"]);
    $password = trim($_POST["password"]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->execute([$credential, $credential]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: index.php");
        exit();

    } else {
        $error = "Wrong Email or Password!";
    }
}
?>



<?php include("../components/header.php"); ?>






<main class="sign-in-or-sign-up-main">
    <div class="sign-in-form-container">
        <form method="post" id="signInForm">
            <label for="username_or_email">Username or Email</label>
            <input type="text" id="username_or_email" name="username_or_email" required placeholder="Username or Email">

            <label for="password_field">Password</label>
            <input type="password" id="password_field" name="password" required placeholder="Password">
            <p class="password-change"><input type="checkbox" id="checkbox" onclick="changePasswordVisibility()"> Show
                Password</p>
            <button type="submit">Sign In</button>
        </form>
        <?php if (!empty($error)): ?>
            <p class="sign-in-error-message-active">
                <?= $error ?>
            </p>
        <?php endif; ?>


    </div>

</main>



<?php include("../components/footer.php"); ?>