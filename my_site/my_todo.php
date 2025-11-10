<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My To-Do List</title>
  <link rel="stylesheet" href="my_style.css">
</head>
<body>
  <?php include_once('nav.php'); ?>

  <h2>My To-Do List</h2>

  <div id="todo_app">
    <input type="text" id="new_task" placeholder="Add a new task">
    <button onclick="addTask()">Add</button>
    <ul id="task_list"></ul>
  </div>
  <?php include_once('footer.php'); ?>
  <script src="todo.js"></script>
</body>
</html>
