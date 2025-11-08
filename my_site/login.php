<?php
$error = '';

$correct_hash = 'b14e9015dae06b5e206c2b37178eac45e193792c5ccf1d48974552614c61f2ff';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $password_hash = hash('sha256', $password);

    if ($password_hash === $correct_hash) {
        header('Location: my_todo.php');
        exit();
    } else {
        $error = 'Incorrect password. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Thomas Jones">
    <title>To-Do Login</title>
    <link rel="stylesheet" href="my_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include_once('nav.php'); ?>

    <div class="body_wrapper">
        <h1>To-Do List Login</h1>
        <p>Please enter the password to access your to-do list.</p>

        <?php if ($error !== ''): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
        </form>
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>
