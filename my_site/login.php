<?php
// MODEL Section: login logic
require_once 'config.php';
session_start();

$error = '';
$logout_message = '';
$username = '';
//Send user back to blog if thats where they came from, otherwise sends to to-do list
$redirect = 'my_todo.php';

if (isset($_GET['redirect']) && $_GET['redirect'] === 'blog.php') {
    $redirect = 'blog.php';
}
if (isset($_POST['redirect']) && $_POST['redirect'] === 'blog.php') {
    $redirect = 'blog.php';
}

$file = 'login_attempts.json';
$attempts = [];

if (file_exists($file)) {
    $json_data = file_get_contents($file);
    $attempts = json_decode($json_data, true);
    if (!is_array($attempts)) {
        $attempts = [];
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    session_start();
    $logout_message = 'Successfully logged out!';
}

if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true && !isset($_POST['logout'])) {
    header('Location: ' . $redirect);
    exit();
}

if (isset($_COOKIE['todo-username'])) {
    $username = $_COOKIE['todo-username'];
}

$correct_hash = 'b14e9015dae06b5e206c2b37178eac45e193792c5ccf1d48974552614c61f2ff';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['logout'])) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $user = $username;

    if ($user !== '') {
        if (!isset($attempts[$user])) {
            $attempts[$user] = [
                'attempts' => 0,
                'locked_until' => 0
            ];
        }

        if ($attempts[$user]['locked_until'] > time()) {
            $seconds_left = $attempts[$user]['locked_until'] - time();
            if ($seconds_left < 0) {
                $seconds_left = 0;
            }

            $error = 'You are still locked out, sorry. Time Left: ' . $seconds_left . ' seconds.';
        } else {
            $password_hash = hash('sha256', $password);

            if ($password_hash === $correct_hash && $username !== '') {
                $attempts[$user]['attempts'] = 0;
                $attempts[$user]['locked_until'] = 0;
                file_put_contents($file, json_encode($attempts));

                setcookie('todo-username', $username, time() + 60 * 60 * 24 * 30);
                $_SESSION['is_logged_in'] = true;
                header('Location: ' . $redirect);
                exit();
            } else {
                $attempts[$user]['attempts'] += 1;

                if ($attempts[$user]['attempts'] >= 3) {
                    $attempts[$user]['locked_until'] = time() + 30;
                    $attempts[$user]['attempts'] = 0;
                    $error = 'Too many wrong attempts. Please wait 30 seconds before trying again.';
                } else {
                    $error = 'Incorrect username or password. Please try again.';
                }

                file_put_contents($file, json_encode($attempts));
            }
        }
    } else {
        $error = 'Incorrect username or password. Please try again.';
    }
}
?>
<!-- VIEW Section: html + simple PHP -->
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
        <?php if ($logout_message !== ''): ?>
            <p style="color: green;"><?php echo htmlspecialchars($logout_message); ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            <input type="hidden" name="redirect" value="<?php
            //keeps redirect info on form submission
                echo isset($_GET['redirect']) && $_GET['redirect'] === 'blog.php'
                    ? 'blog.php'
                    : 'my_todo.php';
                ?>">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br><br>
            
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Login">
        </form>
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>
