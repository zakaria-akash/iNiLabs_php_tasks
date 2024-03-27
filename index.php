<?php
require 'db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>

  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <div class="main-section">
    <div class="add-section">
      <form action="">
        <input type="text" name="title" placeholder="This field is required" />
        <button type="submit">Add &nbsp; <span>&#43;</span></button>
      </form>
    </div>
    <?php
    $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
    ?>
    <div class="show-todo-section">
      <div class="todo-item">
        <input type="checkbox" />
        <h2>This is first item</h2>
        <br>
        <small>created: 28/03/2024</small>
      </div>
    </div>
  </div>
</body>

</html>