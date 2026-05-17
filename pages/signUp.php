<head>
    <title>Sign Up</title>
</head>
<?php
require "../config/db.php";
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = trim($_POST["fullName"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);

    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if ($password !== $confirm_password) {
        $error = "Passwords don't match";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (fullname, email, username, password) VALUES (? , ? , ? , ?)");
            $stmt->execute([$fullName, $email, $username, $password]);


            $_SESSION["user_id"] = $pdo->lastInsertId();
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } catch (Exception $e) {
            $error = "Username or Email already exists.";
        }
    }
}


?>




<?php include("../components/header.php") ?>
<main class="sign-in-or-sign-up-main">
    <div class="sign-up-form-container">
        <form method="post" id="signUpForm">
            <label for="name_field">Full Name</label>
            <input type="text" id="name_field" name="fullName" required placeholder="Full Name" />

            <label for="username_field">Username</label>
            <input type="text" id="username_field" name="username" required placeholder="Username">

            <label for="email_field">Email</label>
            <input type="email" id="email_field" name="email" required placeholder="Email">

            <label for="password_field">Password</label>
            <input type="password" id="password_field" name="password" required placeholder="Password">

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required
                placeholder="Confirm Password">

            <p class="password-change"><input type="checkbox" onclick="changePasswordVisibility()"> Show Password</p>

            <button type="submit">Sign Up</button>
        </form>
        <p class="sign-up-error-message">
            <?= $error ?? "" ?>
        </p>

    </div>

</main>

<?php include("../components/footer.php") ?>