<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My To-Do List</title>
  <link rel="stylesheet" href="my_style.css">
</head>
<body>
  <?php include_once('nav.php'); ?>

  <form action="login.php" method="post" class="logout-form">
    <button type="submit" name="logout" value="1" class="logout-button">Log out</button>
  </form>

  <?php
    $username = '';
    if (isset($_COOKIE['todo-username'])) {
        $username = $_COOKIE['todo-username'];
    }
  ?>

  <h2>
    <?php if ($username !== ''): ?>
      <?php echo htmlspecialchars($username); ?>'s To-Do List
    <?php else: ?>
      My To-Do List
    <?php endif; ?>
  </h2>

  <div id="todo_app">
    <input type="text" id="new_task" placeholder="Add a new task">
    <button onclick="addTask()">Add</button>
    <ul id="task_list"></ul>
  </div>
  <?php include_once('footer.php'); ?>
  <script src="todo.js"></script>
</body>
</html>
