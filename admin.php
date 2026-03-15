<?php
session_start();

// Change this password once! Hash it using password_hash()
$admin_user = "admin";
$admin_pass_hashed = '$2y$10$glbYYJFJl9imr2gOGrYMNuPsCikxSEe4vQL9cm5fQkIUgtClbbKXu'; // Example hash for "password"

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user === $admin_user && password_verify($pass, $admin_pass_hashed)){
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Admin Login</h1>
</header>

<main>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </form>
</main>
</body>
</html>
