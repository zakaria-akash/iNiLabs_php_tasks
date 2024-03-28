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
    <p style="color: #fff; padding: 2rem; font-size: 3rem; font-weight: 900;">To-Do List App</p>
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
      <?php if ($todos->rowCount() <= 0) { ?>
        <div class="todo-item">
          <div class="empty">
            <img src="img/f.png" width="100%" />
            <img src="img/Ellipsis.gif" width="80px">
          </div>
        </div>
      <?php } ?>

      <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="todo-item">
          <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
          <?php if ($todo['checked']) { ?>
            <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" checked />
            <h2 class="checked">
              <?php echo $todo['title'] ?>
            </h2>
          <?php } else { ?>
            <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box" />
            <h2>
              <?php echo $todo['title'] ?>
            </h2>
          <?php } ?>
          <br>
          <small>created:
            <?php echo $todo['date_time'] ?>
          </small>
        </div>
      <?php } ?>
    </div>
  </div>
</body>

</html>