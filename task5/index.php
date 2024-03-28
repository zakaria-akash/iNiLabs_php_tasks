<!-- Task 5: To-Do Module** (Mandatory)
Develop a simple To-do crud module using Laravel Framework. Use VueJs for the view rendering (Optional), that will be a
huge advantage for you as currently we are working with SPA in our company. If you do not know VueJs, then its ok to use
blade view rending for the module -->

<?php
// Require the 'db_conn.php' file to establish a database connection
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
      <form action="app/add.php" method="POST" autocomplete="off">
        <!-- If the 'mess' parameter is set in the GET request and its value is 'error', display an input field with a red border -->
        <!-- Otherwise, display a regular input field without any special styling -->
        <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
          <input type="text" name="title" style="border-color: #ff6666" placeholder="This field is required" />
          <button type="submit">New Note &nbsp; <span>&#43;</span></button>

        <?php } else { ?>
          <input type="text" name="title" placeholder="What do you need to do?" />
          <button type="submit">New Note &nbsp; <span>&#43;</span></button>
        <?php } ?>
      </form>
    </div>
    <?php
    // Query the database to select all todos, ordering them by ID in descending order
    $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
    ?>
    <div class="show-todo-section">
      <!-- If there are no todos in the database, display a message indicating emptiness along with some visual elements -->
      <?php if ($todos->rowCount() <= 0) { ?>
        <div class="todo-item">
          <div class="empty">
            <img src="img/f.png" width="100%" />
            <img src="img/Ellipsis.gif" width="80px">
          </div>
        </div>
      <?php } ?>
      <!-- Loop through each todo retrieved from the database and display it along with its status and creation date -->
      <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="todo-item">
          <span id="<?php echo $todo['id']; ?>" class="remove-to-do">x</span>
          <!-- If the todo is checked, display it with a checkbox and a class indicating it's checked -->
          <?php if ($todo['checked']) { ?>
            <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" checked />
            <h2 class="checked">
              <?php echo $todo['title'] ?>
            </h2>
          <?php } else { ?>
            <!-- If the todo is not checked, display it with a checkbox -->
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

    <a href="https://github.com/zakaria-akash" target="_blank"
      style="color: #9897A9; padding: 2rem; font-size: 1rem; font-weight: 500; text-decoration: none; margin-top: auto;">&#169;
      Zakaria
      Ibrahim</a>
  </div>

  <script src="js/jquery-3.2.1.min.js"></script>
  <script>
    $(document).ready(function () {
      // Execute the following code when the document is fully loaded and ready

      $('.remove-to-do').click(function () {
        // Attach a click event handler to all elements with the class 'remove-to-do'

        const id = $(this).attr('id');
        // Retrieve the value of the 'id' attribute of the clicked element

        $.post("app/remove.php",
          {
            id: id
          },
          // Send a POST request to 'app/remove.php' with the 'id' parameter containing the todo item's ID

          (data) => {
            // Callback function executed when the POST request is completed

            if (data) {
              // If the request is successful (i.e., data is returned)

              $(this).parent().hide(600);
              // Hide the parent element of the clicked element with a 600 milliseconds animation
            }
          }
        );
      });

      $(".check-box").click(function (e) {
        // Attach a click event handler to all elements with the class 'check-box'

        const id = $(this).attr('data-todo-id');
        // Retrieve the value of the 'data-todo-id' attribute of the clicked element

        $.post('app/check.php',
          {
            id: id
          },
          // Send a POST request to 'app/check.php' with the 'id' parameter containing the todo item's ID

          (data) => {
            // Callback function executed when the POST request is completed

            if (data != 'error') {
              // If the request is successful (i.e., data is returned and it's not 'error')

              const h2 = $(this).next();
              // Get the next sibling element (the <h2> tag) of the clicked element

              if (data === '1') {
                // If the returned data is '1' (indicating the todo item is checked)

                h2.removeClass('checked');
                // Remove the 'checked' class from the <h2> tag
              } else {
                // Otherwise (if the returned data is not '1')

                h2.addClass('checked');
                // Add the 'checked' class to the <h2> tag
              }
            }
          }
        );
      });
    });
  </script>
</body>

</html>